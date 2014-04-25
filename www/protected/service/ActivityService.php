<?php 
Doo::loadClassAt("Base/BaseService");
/**
 * 
 * @author lhj
 *
 */
class ActivityService extends BaseService {

	private static $_actObj = null;
	private static $_actOrderObj = null;
	private static $_actTopicObj = null;
	private static $_actCommentObj = null;

	public function __construct(){
		
	}

	/**
	* fun: getActObj
	* 
	*/
	public function getActObj(array $info=array()){
		//if(self::$_actObj == null)
			self::$_actObj = $this->model("QinziActivities",$info);
		return self::$_actObj;
	}
	/**
	* fun: getActOrderObj
	* 
	*/
	public function getActOrderObj(array $info=array()){
		//if(self::$_actOrderObj == null)
			self::$_actOrderObj = $this->model("QinziActivitiyOrders",$info);
		return self::$_actOrderObj;
	}
	/**
	* fun: getActTopicObj
	* 
	*/
	public function getActTopicObj(array $info=array()){
		//if(self::$_actTopicObj == null)
			self::$_actTopicObj = $this->model("QinziActivitiyTopics",$info);
		return self::$_actTopicObj;
	}

	/**
	* fun: getActCommentObj
	* 
	*/
	public function getActCommentObj(array $info=array()){
		//if(self::$_actCommentObj == null)
			self::$_actCommentObj = $this->model("QinziActivitiyComments",$info);
		return self::$_actCommentObj;
	}

	/**
	* fun: getUserObj
	* 
	*/
	public function getUserObj(array $info=array()){
		//if(self::$_userObj == null)
			self::$_userObj = $this->model("QinziUsers",$info);
		return self::$_userObj;
	}

	/**
	 * fun: saveActCmt
	 * des: 保存评论
	 *
	 * @param array $params [aid, uid, type, content [,pic,parentid]]
	 * @return void
	 * @author 
	 **/
	public function saveActCmt(array $params=array())
	{	
		$rec = array('result'=>0, 'message'=>null, 'data'=>null);
		if(!$params['aid'] || !$params['uid'] || !$params['content']){
			$rec['message'] = 'Parameters cannot be empty';
			return $rec;
		}
		$params['type'] = isset($params['type'])? $params['type'] : 0;
		$data = $params;
		$res = $this->getActCommentObj($data)->insert();
	}

	/**
	 * fun: getComments
	 * des: 评论信息列
	 *  
	 * @param int $type 0活动，1用户
	 * @param int $id 对应 $type值 
	 * @param int $callType 0活动，1感想
	 * @param int $limit 0 所有
	 * @param int $start 0
	 * @return void
	 * @author 
	 **/
	public function getComments($type=0, $id=0, $callType=0,$limit=0, $start=0, $lasttime = 0)
	{
		$conf = array();
		$where = array('type='.$callType);
		if ($type == 0) {
			$where[] = 'aid='.intval($id);
			$where[] = 'parentid=0';
		}elseif ($type == 1) {
			$where[] = 'uid='.intval($id);
		}
		if($lasttime){
			$where[] = 'createtime > '.intval($lasttime);
		}
		count($where) && $conf['where'] = implode(' AND ', $where);

		if($limit){
			$conf['limit'] = $start? $start.','.$limit : $limit;
		}


		$aCmt = $this->getActCommentObj()->find($conf);

		if(!$aCmt) return array();

		$aids = $uids = $cmtlist = $parentids= $subCmt = array();
		foreach ($aCmt as $cmt) {
			$aids[$cmt->aid] = $cmt->aid;
			$uids[$cmt->uid] = $cmt->uid;
			$cmt->parentid && $parentids[$cmt->parentid] = $cmt->parentid;
		}

		if($type == 0 && count($parentids)){
			$conf['where'] = ' id IN ('. implode(',', $parentids) .')';
			$subCmt = $this->getActCommentObj()->find($conf);
			foreach ($subCmt as $val) {
				$uids[$val->uid] = $val->uid;
			}
		}

		//活动id,获取用户信息
		if($type == 0 && count($uids)){
			$uconf['where'] = 'uid IN ('. implode(',', $uids) .')';
			$auser = $this->getUserObj()->find($uconf);
			if(!$auser) return array();

			$auser = convertToArray($auser, 'uid');

			//回复的评论
			$tmpSubCmt = array();
			if(count($subCmt)){					
				foreach ($subCmt as &$val) {
					$val->nick = $auser[$val->uid]->nick;
					$val->avatar = echoUserAvatar($auser[$val->uid]->avatar);
					$tmpSubCmt[$val->parentid][] = $val;
				}
			}
			//合并
			foreach ($aCmt as &$cmt) {
				$cmt->nick = $auser[$cmt->uid]->nick;
				$cmt->avatar = echoUserAvatar($auser[$cmt->uid]->avatar);

				//回复的评论
				if (isset($tmpSubCmt[$cmt->id])) {
					$cmt->sublist = $tmpSubCmt[$cmt->id];
				}
			}
			return $aCmt;
		}

		//我的回复的活动列【用户id，获取是那个活动】
		if($type == 1 && count($aids)){
			$aconf['where'] = 'aid IN ('. implode(',', $aids) .')';
			$aact = $this->getActObj()->find($aconf);
			if(!$aact) return array();
			$aact = convertToArray($aact, 'aid');
			foreach ($aCmt as &$cmt) {
				$cmt->title = $aact[$cmt->aid]->title;
			}
			return $aCmt;
		}

		return $aCmt;
	}

	/**
	 * fun: getActList
	 * des：获取活动信息
	 *
	 * @param mixed $ids 活动id
	 * @param int $limit 0 所有
	 * @param int $start 0 
	 * @return void
	 * @author 
	 **/
	public function getActList($ids=null, $limit=0, $start=0){
		$conf = array();
		if(is_numeric($ids)){
			$$where = 'aid='.$ids;
		}elseif (is_array($ids)) {
			$conf['where'] = 'aid IN ('.implode(',', $ids).')';
		}elseif (strpos($ids, ',')) {
			$conf['where'] = 'aid IN ('.$ids.')';
		}

		if($limit){
			$conf['limit'] = $start? $start.','.$limit : $limit;
		}

		return $this->getActObj()->find($conf);
	}

	/**
	* fun: actApply
	* des: 活动报名
	*
	* @param int $uid
	* @param int $aid
	* @param array $params [cnt,realname,mobile,address,postcode]
	* @return array A
	*/
	public function actApply($uid=0, $aid, array $params=array()){
		$rec = array('result'=>0, 'message'=>'', 'data'=>null);
		if(!$uid || !$aid || empty($params['realname']) || empty($params['mobile'])) {
			$rec['message'] = 'Incorrect parameter';
			return $rec;
		}
		$cond = array(
			'where'	=> 'aid=?',
			'param'=>array($aid)
		);
		$actInfo = $this->getActObj()->getOne($cond);
		if(!$actInfo){
			$rec['message'] = 'activity not find';
			return $rec;
		}
		
		//是否报告名
		$cond = array(
			'where'	=> 'uid=? AND aid=?',
			'param'=>array($uid, $aid)
		);
		$actOrderCnt = $this->getActOrderObj()->count($cond);
		if($actOrderCnt){
			$rec['message'] = '已经报过名';
			return $rec;
		}

		$data['aid'] = $aid;
		$data['uid'] = $uid;
		$data['title'] = $actInfo->title;
		$data['realname'] = $params['realname'];
		$data['mobile'] = $params['mobile'];
		$data['cnt'] = isset($params['cnt'])?intval($params['cnt']):1;
		$data['address'] = isset($params['address'])?$params['address']:'';
		$data['postcode'] = isset($params['postcode'])?$params['postcode']:'';
		$data['createtime'] = time();

		$res = $this->getActOrderObj($data)->insert();
		if(!$res){
			$rec['message'] = '报名失败';
			return $rec;
		}
		//更新数据
		$cdata['b_cnt'] = array('asc'=>1);
		$cond = array(
			'where'	=> 'aid=?',
			'param'=>array($aid)
		);
		$res = $this->getActObj($cdata)->updateCnt($cond);
		$rec['result'] = 1;
		$rec['message'] = '报名成功';
		return $rec;
	}//actApply

	/**
	* fun: actApplyApproval
	* des: 活动报名审批
	*
	* @param int|string $ids 多个用逗号相隔
	* @param int $state 状态[1报名失败，2报名成功]
	*/
	public function actApplyApproval($ids, $state=2){
		$rec = array('result'=>0, 'message'=>'','data'=>null);
		if(!$ids) {
			$rec['message'] = 'Incorrect parameter';
			return $rec;
		}
		
		$data['state'] = intval($state);
		$cond = array(
			'where'	=> 'aoid'.(strpos($ids,',')?' IN ('.$ids.')':'='.$ids)
		);
		$upCnt = $this->getActOrderObj($data)->update($cond);
		if(!$upCnt){
			$rec['message'] = '更新失败';
			return $rec;
		}
		//报名成功
		if($state == 2){
			$actInfo = $this->getActObj()->getOne($cond);
			//更新数据
			$cdata['used_cnt'] = array('asc'=>$upCnt);
			$cdata['remain_cnt'] = array('desc'=>$upCnt);
			$cond = array(
				'where'	=> 'aid=?',
				'param'=>array($actInfo->aid)
			);
			$res = $this->getActObj($cdata)->updateCnt($cond);
		}
		
		$rec['result'] = 1;
		$rec['message'] = '更新成功';
		return $rec;
	}//actApplyApproval

	/**
	 * fun: saveActTopic
	 * des: 保存活动感想
	 *
	 * @param int $uid
	 * @param int $aid
	 * @param array $params [title, content]
	 * @return void
	 * @author 
	 **/
	public function saveActTopic($uid, $aid, array $params = array()){
		$rec = array('result'=>0, 'message'=>'','data'=>null);
		if(!$uid || !$aid || empty($params['title']) || empty($params['content']) ) {
			$rec['message'] = 'Incorrect parameter';
			return $rec;
		}

		$conf = array(
	        'where' => 'aid=?',
	        'param' => array($aid)
	     );
	    $actinfo = $this->getActObj()->getOne($conf);
	    if(!$actinfo){
	    	$rec['message'] = '活动没找到';
			return $rec;
	    }

		$data['uid'] = $uid;
		$data['aid'] = $aid;
		$data['title'] = $params['title'];
		$data['content'] = $params['content'];
		//处理内容中的图片
		//coding
		$picurl = '';
		$data['pic'] = $picurl;

		$res = $this->getActTopicObj($data)->insert();
		if(!$res){
			$rec['message'] = '保存失败';
			return $rec;
		}
		$rec['result'] = 1;
		$rec['data'] = $res;
		return $rec;
	}
}


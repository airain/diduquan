<?php
Doo::loadClassAt("Base/BaseService");
/**
 *
 * @author lhj
 *
 */
class TryService extends BaseService {

	private static $_proObj = null;
	private static $_proAppObj = null;
	private static $_proTopicObj = null;
	private static $_userObj = null;

	public function __construct(){

	}

	/**
	* fun: getProObj
	*
	*/
	public function getProObj(array $info=array()){
		if(self::$_proObj == null || !empty($info))
			self::$_proObj = $this->model("QinziProducts",$info);
		return self::$_proObj;
	}
	/**
	* fun: getProAppObj
	*
	*/
	public function getProAppObj(array $info=array()){
		if(self::$_proAppObj == null || !empty($info))
			self::$_proAppObj = $this->model("QinziProductApplies",$info);
		return self::$_proAppObj;
	}
	/**
	* fun: getProTopicObj
	*
	*/
	public function getProTopicObj(array $info=array()){
		if(self::$_proTopicObj == null || !empty($info))
			self::$_proTopicObj = $this->model("QinziProductTopics",$info);
		return self::$_proTopicObj;
	}

	/**
	* fun: getUserObj
	*
	*/
	public function getUserObj(array $info=array()){
		if(self::$_userObj == null || !empty($info))
			self::$_userObj = $this->model("QinziUsers",$info);
		return self::$_userObj;
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


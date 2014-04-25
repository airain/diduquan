<?php
Doo::loadClassAt("Base/BaseService");
/**
 *
 * @author lhj
 *
 */
class ProductService extends BaseService {

	private static $_proObj = null;
	private static $_proApplyObj = null;
	private static $_proTopicObj = null;

	public function __construct(){

	}

	/**
	* fun: getProObj
	*
	*/
	public function getProObj(array $info=array()){
		//if(self::$_proObj == null)
			self::$_proObj = $this->model("QinziProducts",$info);
		return self::$_proObj;
	}
	/**
	* fun: getProApplyObj
	*
	*/
	public function getProApplyObj(array $info=array()){
		//if(self::$_proApplyObj == null)
			self::$_proApplyObj = $this->model("QinziProductApplies",$info);
		return self::$_proApplyObj;
	}
	/**
	* fun: getProTopicObj
	*
	*/
	public function getProTopicObj(array $info=array()){
		//if(self::$_proTopicObj == null)
			self::$_proTopicObj = $this->model("QinziProductTopics",$info);
		return self::$_proTopicObj;
	}


	/**
	* fun: proApply
	* des: 申请使用
	*
	* @param int $uid
	* @param int $pid
	* @param string $desc
	* @return array A
	*/
	public function proApply($uid=0, $pid, $desc=''){
		$rec = array('result'=>0, 'message'=>'','data'=>null);
		if(!$uid || !$pid || !$desc) {
			$rec['message'] = 'Incorrect parameter';
			return $rec;
		}
		$cond = array(
			'where'	=> 'pid=?',
			'param'=>array($pid)
		);
		$proInfo = $this->getProObj()->getOne($cond);
		if(!$proInfo){
			$rec['message'] = 'infomation not find';
			return $rec;
		}

		//是否报告名
		$cond = array(
			'where'	=> 'uid=? AND pid=?',
			'param'=>array($uid, $pid)
		);
		$proApplyCnt = $this->getProApplyObj()->count($cond);
		if($proApplyCnt){
			$rec['message'] = '已申请';
			return $rec;
		}
		if($proInfo->jifen > 0){
			//是否满足积分邀请
			Doo::loadService('UserService');
			$userServ = new UserService();
			$userInfo = $userServ->getUserInfo($uid);
			if(!$userInfo || $userInfo['jifen'] - $proInfo->jifen < 0){
				$rec['message'] = '积分不足';
				return $rec;
			}
		}

		$data['pid'] = $pid;
		$data['uid'] = $uid;
		$data['title'] = $proInfo->title;
		$data['des'] = $desc;
		$data['createtime'] = time();
		$res = $this->getProApplyObj($data)->insert();
		if(!$res){
			$rec['message'] = '申请失败';
			return $rec;
		}
		//更新数据
		$cdata['b_cnt'] = array('asc'=>1);
		$cond = array(
			'where'	=> 'pid=?',
			'param'=>array($pid)
		);
		$res = $this->getProObj($cdata)->updateCnt($cond);
		//扣除积分
		if($proInfo->jifen > 0){
			//Doo::loadService('RuleService');
			//$ruleServ = new RuleService();
			//$ruleServ->addJifen($uid, 'save_pro', array('score'=>0-$proInfo->jifen,'info'=>'[申请试用]'.$proInfo->title));
		}
		$rec['result'] = 1;
		$rec['message'] = '申请成功';
		return $rec;
	}//proApply

	/**
	* fun: proApplyApproval
	* des: 申请试用审批
	*
	* @param int|string $ids 多个用逗号相隔
	* @param int $state 状态[0审核中，1未通过，2通过]
	*/
	public function proApplyApproval($ids, $state=2){
		$rec = array('result'=>0, 'message'=>'','data'=>null);
		if(!$ids) {
			$rec['message'] = 'Incorrect parameter';
			return $rec;
		}

		$data['state'] = intval($state);
		$cond = array(
			'where'	=> 'ppid'.(strpos($ids,',')?' IN ('.$ids.')':'='.$ids)
		);
		$upCnt = $this->getProApplyObj($data)->update($cond);
		if(!$upCnt){
			$rec['message'] = '更新失败';
			return $rec;
		}
		//报名成功
		if($state == 2){
			$proInfo = $this->getProObj()->getOne($cond);
			//更新数据
			$cdata['used_cnt'] = array('asc'=>$upCnt);
			$cdata['remain_cnt'] = array('desc'=>$upCnt);
			$cond = array(
				'where'	=> 'pid=?',
				'param'=>array($proInfo->pid)
			);
			$res = $this->getProObj($cdata)->updateCnt($cond);
		}

		$rec['result'] = 1;
		$rec['message'] = '更新成功';
		return $rec;
	}//proApplyApproval

	/**
	* fun: proSaveTopicApproval
	* des: 提交试用报告
	*
	* @param int $uid
	* @param int $pid
	* @param string $title
	* @param string $content
	* @return array A
	*/
	public function proSaveTopicApproval($uid, $pid, $title, $content){
		$rec = array('result'=>0, 'message'=>'','data'=>null);
		if(!$uid || !$pid || empty($title) || empty($content)) {
			$rec['message'] = 'Incorrect parameter';
			return $rec;
		}

		$cond = array(
			'where'	=> 'pid=?',
			'param'=>array($pid)
		);
		$proInfo = $this->getProObj()->getOne($cond);
		if(!$proInfo){
			$rec['message'] = 'Not find product';
			return $rec;
		}
		$tmp = strip_tags($content);
		$des = mb_substr($tmp, 0, 100);
		//字数大于300，积分奖励
		$score = mb_strlen($tmp) > 300? $proInfo['reward_jifen'] : 0;

		$data['uid'] = $uid;
		$data['pid'] = $pid;
		$data['title'] = $title;
		$data['des'] = $des;
		$data['content'] = $content;
		$imgs = getContentImgs($content);
		$data['img_cnt'] = $imgs['cnt'];
		$data['reward_jifen'] = $score;
		$data['createtime'] = time();
		if(!$this->getProTopicObj($data)->insert()){
			$rec['message'] = '保存失败';
			return $rec;
		}
		//更新积分
		//Doo::loadService('RuleService');
		//$ruleServ = new RuleService();
		//$ruleServ->addJifen($uid, 'save_pro', array('score'=>$score,'info'=>'[提交报告]'.$proInfo['title']));

		$rec['result'] = 1;
		$rec['message'] = '保存成功';
		return $rec;
	}//proSaveTopicApproval



}


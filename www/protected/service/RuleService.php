<?php 
Doo::loadClassAt("Base/BaseService");
/**
 * 
 * @author lhj
 *
 */
class RuleService extends BaseService {
	
	private static $_userObj = null;
	private static $_ruleObj = null;
	private static $_ruleRecordObj = null;
	
	public function __construct(){
		
	}
	/**
	* fun: getRuleObj
	* 
	*/
	public function getRuleObj(array $info=array()){
		//if(self::$_ruleObj == null)
			self::$_ruleObj = $this->model("QinziRules",$info);
		return self::$_ruleObj;
	}
	/**
	* fun: getRuleRecordObj
	* 
	*/
	public function getRuleRecordObj(array $info=array()){
		//if(self::$_ruleRecordObj == null)
			self::$_ruleRecordObj = $this->model("QinziRuleRecord",$info);
		return self::$_ruleRecordObj;
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
	 * fun: addJifen
	 * des: 添加积分
	 *
	 * @param int $uid
	 * @param string $rule_name
	 * @param array $info [score,info,pre_score]
	 * @return boolean|int A
	 */
	public function addJifen($uid, $rule_name, array $info = array()){
		if(empty($uid) || empty($rule_name)) false;
		$conf = array(
			'where' => 'ename=?',
			'param' => array($rule_name)
		);
		$ruleInfo = $this->getRuleObj()->getOne($conf);
		if(!$ruleInfo) return false;
		$curtime = time();
		//时间间隔内大于规定的次数
		if($ruleInfo->limit_count && $ruleInfo->limit_time){
			$conf = array(
				'where' => 'uid=? AND ename=? AND createtime >=?',
				'param' => array($uid, $rule_name, $curtime - $ruleInfo->limit_time)
			);
			$tmp_count = $this->getRuleRecordObj()->getOne($conf);
			if($tmp_count >= $ruleInfo->limit_count){
				return false;
			}
		}
		$conf = array(
			'where' => 'uid=?',
			'param' => array($uid)
		);

		$infostr = isset($info['info'])? $info['info'] : $ruleInfo->desc;
		$pre_score = isset($info['pre_score'])? $info['pre_score'] : 0;
		if(!$pre_score){
			$userInfo = $this->getUserObj()->getOne($conf);
			$pre_score = $userInfo->jifen;
		}
		$score = isset($info['score'])? intval($info['score']) : ((int)($ruleInfo->type . $ruleInfo->score));

		//扣除积分
		$data['jifen'] = array('asc'=>$score);
		$res = $this->getUserObj($data)->updateCnt($conf);
		if(!$res) return false;
		//保存记录
		$info['uid'] = $uid;
		$info['name'] = $ruleInfo->name;
		$info['score'] = $score;
		$info['ename'] = $rule_name;
		$info['pre_score'] = $pre_score;
		$info['info'] = $infostr;
		$info['createtime'] = time();
		$res = $this->getRuleRecordObj($info)->insert();
		if(!$res){
			//保存记录失败，回复扣除的积分
			$data['jifen'] = array('asc'=>0-$score);
			$this->getUserObj($data)->updateCnt($conf);
		}
		return $res;
	}//addJifen
	
}


<?php 
Doo::loadClassAt("Base/BaseService");
/**
 * 
 * @author lhj
 *
 */
class UserService extends BaseService {

	private static $_userObj = null;
	private static $_userSnsObj = null;
	private static $_userBabyObj = null;

	private $_sns_sites = array('sina','space');
	
	public function __construct(){
		
	}

	//------------------- user start ------------------------

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
	* fun: getUserSnsObj
	* 
	*/
	public function getUserSnsObj(array $info=array()){
		//if(self::$_userSnsObj == null)
			self::$_userSnsObj = $this->model("QinziUserSns",$info);
		return self::$_userSnsObj;
	}
	/**
	* fun: getUserBabyObj
	* 
	*/
	public function getUserBabyObj(array $info=array()){
		//if(self::$_userBabyObj == null)
			self::$_userBabyObj = $this->model("QinziUserBabies",$info);
		return self::$_userBabyObj;
	}

	/**
	* fun: getUserInfo
	* des: 获取用户信息
	*
	* @param int $uid
	* @return array A
	*/
	public function getUserInfo($uid=0){
		if(!is_int($uid) || !intval($uid)) return array();
		$cond = array(
			'where'	=> 'uid=?',
			'param'=>array($uid)
		);
		$userInfo = $this->getUserObj()->getOne($cond);
	}
	
	/**
	* fun: login
	* des: 登录
	*
	* @param string $nick
	* @param string $pwd
	* @param array $params [snsinfo[sns_site,site_uid,site_name,sns_token,sns_secret,sns_expires]] 
	* @return array A
	*/
	public function login($nick='', $pwd, array $params=array()){
		if((empty($nick) || empty($pwd)) && empty($params['snsinfo']) ) return array();
		Doo::loadClassAt('Security');
		$rec = array('result'=>0, 'message'=>'', 'data'=>null);
		$snsInfo = isset($params['snsinfo'])?$params['snsinfo']:array();
		//如果是正常登录
		if($nick && $pwd){
			$pwd = Security::Encrypt($pwd, Doo::conf()->SECRET_KEY);
			
			$cond = array(
				'where'	=> 'nick=?',
				'param'=>array($nick)
			);
			$userInfo = $this->getUserObj()->getOne($cond);
			$rec = $this->checkedUser($userInfo, $pwd);
			return $rec;
		}
		//第三方登录
		if(empty($snsInfo['sns_site']) || !in_array($snsInfo['sns_site'], $this->_sns_sites) || empty($snsInfo['sns_uid'])){
			$rec['result'] = 0;
			$rec['message'] = 'login failed';
			return $rec;
		}
		$cond = array(
			'where' => 'sns_site=? AND sns_uid=?',
			'param' => array($snsInfo['sns_site'],$snsInfo['sns_uid'])
		);
		$userSnsInfo = $this->getUserSnsObj()->getOne($cond);
		if(!$userSnsInfo){
			$rec['result'] = 0;
			$rec['message'] = 'not find snsinfo';
			return $rec;
		}
		//更新sns信息
		//$snsInfo['uptime'] = time();
		$this->getUserSnsObj($snsInfo)->update($cond);
		//获取用户信息
		$userInfo = $this->getUserInfo($userSnsInfo->uid);
		$rec = $this->checkedUser($userInfo);
		return $rec;
	}//login

	/**
	* fun: checkedUser
	* des: 检查登录用户信息
	* 
	* @param array $userInfo 
	*/
	private function checkedUser($userInfo=array(), $pwd=null){
		$rec = array('result'=>0, 'message'=>'', 'data'=>null);
		if(!$userInfo){
			$rec['result'] = 0;
			$rec['message'] = 'not find user';
			return $rec;
		}
		if($userInfo->status == 1){
			$rec['result'] = 0;
			$rec['message'] = 'user baned';
			return $rec;
		}
		if($pwd != null && $userInfo->pwd != $pwd){
			$rec['result'] = 0;
			$rec['message'] = 'nick or password is not match';
			return $rec;
		}
		Doo::loadService('RuleService');
		$ruleServ = new RuleService();
		$ruleServ->addJifen($userInfo->uid, 'login');

		$rec['result'] = 1;
		$rec['data'] = $userInfo;
		return $rec;
	}//checkedUser

	/**
	* fun: createUser
	* des: 注册用户
	* 
	* @param array $params
	* @return array A
	*/
	public function createUser(array $params=array()){
		$rec = array('result'=>0, 'message'=>'', 'data'=>null);
		
		$snsInfo = isset($params['snsinfo'])?$params['snsinfo']:array();

		//验证昵称
		$nickRec = $this->verifyNick($params['nick']);
		if($nickRec['result'] < 1) return $nickRec;

		//验证邮箱
		$emailRec = $this->verifyEmail($params['email']);
		if($emailRec['result'] < 1) return $emailRec;
		
		//检查密码
		$pwdRec = verify_password($params['password']);
		if($pwdRec['result'] < 1) return $pwdRec;

		Doo::loadClassAt('Security');
		$pwd = Security::Encrypt($params['password'], Doo::conf()->SECRET_KEY);
		
		$data['nick'] = $params['nick'];
		$data['pwd'] = $pwd;
		$data['email'] = $params['email'];
		$data['regtime'] = time();
		//保存信息
		$res = $this->getUserObj($data)->insert();
		if(!$res){
			$rec['result'] = 0;
			$rec['message'] = '注册失败';
			return $rec;
		}
		$uid = $this->getUserObj()->lastInsertId();
		//第三方注册信息
		if($snsInfo){
			$snsInfo['uid'] = $uid;
			$res = $this->getUserSnsObj($snsInfo)->insert();
			if(!$res){
				$cond = array(
					'where'	=> 'uid=?',
					'param'=>array($uid)
				);
				$this->getUserObj()->delete($cond);
				$rec['result'] = 0;
				$rec['message'] = '注册失败';
				return $rec;
			}
		}

		$rec['result'] = 1;
		$rec['data'] = $this->getUserInfo($uid);
		return $rec;
	}//createUser

	/**
	* fun: verifyEmail
	* des: 验证邮箱是否存在
	* 
	* @param string $email
	* @param int $uid
	* @return array A
	*/
	public function verifyEmail($email, $uid=0){
		$rec = array('result'=>0, 'message'=>'', 'data'=>null, 'type'=>'email');
		if(!isset($email) || empty($email)){
			$rec['result'] = 0;
			$rec['message'] = '请输入邮箱地址';
			return $rec;
		}
    
		//邮箱格式
		$match = '';
		$email = mb_strtolower(trim($email));
		if(!preg_match("/^[\.\-\_\+0-9a-z]{2,}@([a-z0-9\-\_]+\.)+[a-z]{2,}$/i",$email,$match)){
			$rec['result'] = 0;
			$rec['message'] = '邮箱格式不正确';
			return $rec;
		}

		$cond = array(
			'where'	=> 'email=?',
			'param'=>array($email)
		);
		$userInfo = $this->getUserObj()->getOne($cond);
		if((!$uid && $userInfo) || ($uid && $uid != $userInfo['uid'])){
			$rec['result'] = 0;
			$rec['message'] = '此邮箱已被注册';
			return $rec;
		}
		$rec['result'] = 1;
		return $rec;
		
	}//verifyEmail

		/**
	* fun: verifyNick
	* des: 验证邮箱是否存在
	* 
	* @param string $nick
	* @param int $uid
	* @param int $minlen
	* @param int $maxlen
	* @return array A
	*/
	public function verifyNick($nick, $uid=0, $minlen=4, $maxlen=30){
		$rec = array('result'=>0, 'message'=>'', 'data'=>null, 'type'=>'nick');
		if(!isset($nick) || empty($nick)){
			$rec['result'] = 0;
			$rec['message'] = '请输入昵称';
			return $rec;
		}
    
		//长度
		if(mb_strwidth ($nick) < $minlen){
			$rec['result'] = 0;
			$rec['message'] = '昵称为'.($minlen/2).'-'.($maxlen/2).'个中文/'.$minlen.'-'.$maxlen.'个英文';
			return $rec;
		}
		if(mb_strwidth($nick) > $maxlen){
			$rec['result'] = 0;
			$rec['message'] = '昵称为'.($minlen/2).'-'.($maxlen/2).'个中文/'.$minlen.'-'.$maxlen.'个英文';
			return $rec;
		}
		//昵称包含字符
		preg_match ("/(([\x{4e00}-\x{9fa5}]|[\x{e7c7}-\x{e7f3}]|[a-zA-Z0-9_-])*)/u", $nick, $matches);
		if(!isset($matches[0]) || $matches[0]!=$nick){
			$rec['result'] = 0;
			$rec['message'] = '昵称支持中英文、数字、下划线';
			return $rec;
		}

		$cond = array(
			'where'	=> 'nick=?',
			'param'=>array($nick)
		);
		$userInfo = $this->getUserObj()->getOne($cond);
		if((!$uid && $userInfo) || ($uid && $uid != $userInfo['uid'])){
			$rec['result'] = 0;
			$rec['message'] = '昵称太受欢迎，已有人抢了';
			return $rec;
		}
		$rec['result'] = 1;
		return $rec;
		
	}//verifyNick
	
	//------------------- user end ------------------------

	//------------------- message start ------------------------
	private static $_userMsgObj = null;

	/**
	* fun: getUserMsgObj
	* 
	*/
	public function getUserMsgObj(array $info=array()){
		//if(self::$_userMsgObj == null)
			self::$_userMsgObj = $this->model("QinziUserMessages",$info);
		return self::$_userMsgObj;
	}

	/**
	 * fun: getMessage
	 * des: 获取消息列
	 *
	 * @return void
	 * @author 
	 **/
	public function getMessageList($uid=0, $limit=10, $start=0)
	{
		if(!$uid) return array();
		$limit = $start? 'LIMIT '.$start.','.$limit : 'LIMIT '.$limit;
		$sql = 'SELECT um.*, u.avatar, u.nick FROM '.$this->getUserMsgObj()->_table.' um, '.$this->getUserObj()->_table.' u
			WHERE um.uid=u.uid AND um.state=0 AND um.touid='.$uid.
			' ORDER BY um.id DESC '.$limit;
		$rec = $this->getUserMsgObj()->fetchAll($sql);
		
		return $rec;
	}

	/**
	* fun: sendMessage
	* des: 发送私信
	* 
	* @param int $uid
	* @param int $touid
	* @param string $message
	* @param int $type 0 普通消息，1系统消息，2添加好友
	* @return array A
	*/
	public function sendMessage($uid, $touid, $message='', $type=0){
		$rec = array('result'=>0, 'message'=>'', 'data'=>null);
		if(empty($uid) || empty($touid) || empty($message)){
			$rec['result'] = 0;
			$rec['message'] = '参数不正确';
			return $rec;
		}
		// $userInfo = $this->getUserInfo($uid);
		// $toUserInfo = $this->getUserInfo($touid);
		$data['content'] = $message;
		$data['createtime'] = time();
		$data['uid'] = $uid;
		$data['type'] = $type;
		$data['touid'] = $touid;	
		$res = $this->getUserMsgObj($data)->insert();
		$rec['result'] = 1;
		$rec['data'] = $res;
		return $rec;
	}//sendMessage

	//------------------- message end ------------------------

	//------------------- friend end ------------------------
	private static $_userFriObj = null;

	/**
	* fun: getUserFriObj
	* 
	*/
	public function getUserFriObj(array $info=array()){
		//if(self::$_userFriObj == null)
			self::$_userFriObj = $this->model("QinziUserFriends",$info);
		return self::$_userFriObj;
	}
	
	/**
	* fun: addFriends
	* des: 添加好友
	*/
	public function addFriends($uid, $fuids){
		if(empty($uid) || empty($fuids)) return false;

		if(strpos($fuids,','))  $fuids = explode(',', $fuids);
		else if(!is_array($fuids)) $fuids = array($fuids);
		$data = $fdata = array();
		foreach($fuids as $fuid){
			$data['uid'] = $uid;
			$data['fuid'] = $fuid;
			$this->getUserFriObj($data)->replace();
			$fdata['uid'] = $fuid;
			$fdata['fuid'] = $uid;
			$this->getUserFriObj($fdata)->replace();
		}
		return true;
	}//addFriends

	/**
	 * fun: myfriends
	 * des: 我的好友
	 *
	 * @return array A
	 * @author 
	 **/
	public function myfriends($uid=0, $limit=20, $start = 0)
	{
		if(!$uid) return array();
		$conf = array(
			'where'=>'uid=? AND state=0',
			'param'=>array($uid)
		);
		$limit && $conf['limit'] = $start? $start.', '.$limit : $limit;

		$frilist = $this->getUserFriObj()->find($conf);
		if(!$frilist) return array();

		$fri_uids = array();
		$rec_fri = array();
		foreach ($frilist as $key => $value) {
			$fri_uids[] = $value->fuid;
			$rec_fri[$value->fuid] = $value->fuid;
		}
		$conf = array(
			'where'=> 'uid IN (?)',
			'param'=> array(implode(',', $fri_uids))
		);
		$fusers = $this->getUserObj()->find($conf);

		foreach ($fusers as $key => $value) {
			$rec_fri[$value->uid] = $value;
		}
		return $rec_fri;
	}

	//------------------- friend start ------------------------

}


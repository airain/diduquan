<?php

/**
 * AppController
 * @author hxf
 *
 */
Doo::loadClassAt("Base/AppController");
class BaseController extends AppController {
	
	private $_m_islogin = 0;
	public $_user = null;
	/**
	 * @param string $resource Controller Name
	 * @param string $action Method Name
	 * @see DooController::beforeRun()
	 */
	public function beforeRun($resource, $action){
		$this->vdata['userinfo'] = null;
		parent::beforeRun($resource, $action);
		if (isset($_POST["PHPSESSID"])) session_id($_POST["PHPSESSID"]);
		if(!isset($_SESSION)) session_start();
	}
	
	/**
	 * checkSession
	 * 验证session方法，可覆盖
	 */
	public function checkSession(){
		if((!isset($_SESSION['QINZI_USERINFO']) || empty($_SESSION['QINZI_USERINFO']->uid)) && (!isset($_COOKIE['QINZI_USERINFO']) || strlen($_COOKIE['QINZI_USERINFO']) <= 2)){
			return ;
		}

		if(isset($_SESSION['QINZI_USERINFO']) && $_SESSION['QINZI_USERINFO']->uid){
			$this->_m_islogin = 1;
			$this->_user = $_SESSION['QINZI_USERINFO'];
		}
		if(empty($_SESSION['QINZI_USERINFO']->uid) && isset($_COOKIE['QINZI_USERINFO']) && strlen($_COOKIE['QINZI_USERINFO']) > 2){
			Doo::loadClassAt('Security');
			$secret_str = Security::DecodeString($_COOKIE['QINZI_USERINFO'], Doo::conf()->SECRET_KEY);
			$tmp_user = explode("|", $secret_str);
			Doo::loadModel('QinziUsers');
			$obj = new QinziUsers();
			$obj->uid = $tmp_user[0];
			$this->_user = $_SESSION['QINZI_USERINFO'] = $obj->getOne();
			$this->_m_islogin = 1;
		}
		$this->vdata['userinfo'] = $this->_user;
	}

	/**
	 * fun: isLogin
	 *
	 * @return boolean
	 * @author lhj
	 **/
	protected function isLogin()
	{
		return $this->_m_islogin;
	}
	
	protected function updateUserLoginInfo($user){
		$this->updateSessionUserInfo($user);
		Doo::loadModel('QinziUsers');
		//更新登录相关信息
		$obj = new QinziUsers();
		$obj->uid = $user->uid;
		$obj->last_time = time();
		$obj->last_ip = $this->clientIP();
		$obj->update();
		
		//SESSION
// 		unset();
		
		//TODO 添加日志
		$this->dblog("login",$user->nick);
		
	}


	/**
	* fun: 更新session中的用户信息
	*/
	protected function updateSessionUserInfo($user_field, $value = ''){
		if(is_object($user_field))
			$_SESSION['QINZI_USERINFO'] = $user_field;
		elseif(isset($_SESSION['QINZI_USERINFO']))
			$_SESSION['QINZI_USERINFO']->$user_field = $value;
		else
			return ;
		Doo::loadClassAt('Security');
		$secret_str = Security::EncodeString($user_field->uid.'|'.$user_field->nick.'|'.$user_field->email, Doo::conf()->SECRET_KEY);
		cookie('QINZI_USERINFO', $secret_str);
		$this->_user = $_SESSION['QINZI_USERINFO'];
	}

	
	
	public function afterRun($routeResult){
		/*
		if($this->isAjax()&&is_array($routeResult)){
			$this->autorender = false;
		}
		*/
		parent::afterRun($routeResult);
	}
}
?>
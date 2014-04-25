<?php
Doo::loadClassAt("Base/AppController");

class ModuleController extends AppController {

	protected $_USERINFO = '_ADMIN_USERINFO_';
	private $_isLogin = false;
	private $_resource = '';

	public function beforeRun($resource, $action){
		$this->_resource = $resource;
        $this->setLayOut('');
		parent::beforeRun($resource, $action);
		$this->vdata['title'] .= "-后台管理";
		$this->vdata['script'] = str_replace("page",Doo::conf()->MODULE,$this->vdata['script']);
	}


	/**
	 * fun: UpdateUserSession
	 *
	 * @return void
	 * @author
	 **/
	protected function UpdateUserSession($user, $value=null)
	{
		if(is_array($user) || is_object($user)){
			$_SESSION[$this->_USERINFO] = $user;
		}elseif(isset($_SESSION[$this->_USERINFO])){
			$_SESSION[$this->_USERINFO][$user] = $value;
		}

		return ;
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author
	 **/
	protected function getUserInfo()
	{
		if(isset($_SESSION[$this->_USERINFO])){
			return $_SESSION[$this->_USERINFO];
		}
		return array();
	}

	public function checkSession()
	{
		if(!isset($_SESSION)) session_start();
		if(!$this->getUserInfo() && $this->_resource != 'LoginController'){
			$this->_isLogin = false;
			header("location: /admin/login/");
			return;
		}
		$this->_isLogin = true;
	}

	protected function isLogin()
	{
		if($this->_isLogin){
			return $this->getUserInfo();
		}
		return array();
	}
}
?>
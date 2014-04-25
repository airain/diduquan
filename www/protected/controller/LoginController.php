<?php
/**
 * MainController
 * Feel free to delete the methods and replace them with your own code.
 *
 * @author darkredz
 */
Doo::loadClassAt("Base/BaseController");
class LoginController extends BaseController{

	private $userServ = null;

	public function beforeRun($resource, $action){
		parent::beforeRun($resource, $action);
		$this->vdata['title'] = "登录-".$this->vdata['title'];
		$this->setLayOut('default-login');
		//$this->setLayOut('default-boot');
	}

	public function getUserServ(){
		if(!$this->userServ){
			Doo::loadService("UserService");
			$this->userServ = new UserService();
		}
		return $this->userServ;
	}
	
	public function index(){

		Doo::loadModel("QinziUsers");
		$qzObj = new QinziUsers(array('nick'=>'adfasd'));
		//$qzObj->nick = "huxf2";
		// $qzObj->insert();



		$this->viewRenderAutomation();
	}
	
	private function autoLogin(){
		
	}
	
	public function ajax(){
		$username = gpc_get("username","");
		$password = gpc_get("password","");
		
		if($username==""){
			return $this->echoMessage(0,"登录名不能为空");
		}
		
		if($password==""){
			return $this->echoMessage(0,"密码不能为空");
		}
		$res = $this->getUserServ()->login($username, $password);

		if($res['result']){
			$this->updateUserLoginInfo($res['data']);
			$res['BACK_URL'] = '/member/';
		}
		return $this->echoMessage($res['result'],$res['message'], $res);
	}

}
?>
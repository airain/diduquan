<?php
/**
 * MainController
 * Feel free to delete the methods and replace them with your own code.
 *
 * @author darkredz
 */
Doo::loadClassAt("Base/BaseController");
class RegisterController extends BaseController{

	private $userServ = null;
	
	public function beforeRun($resource, $action){
		parent::beforeRun($resource, $action);
		$this->vdata['title'] = "注册-".$this->vdata['title'];
		$this->setLayOut('default-login');
	}
	

	public function getUserServ(){
		if(!$this->userServ){
			Doo::loadService("UserService");
			$this->userServ = new UserService();
		}
		return $this->userServ;
	}

	public function index(){

		$this->viewRenderAutomation();
	}
	
	public function ajax(){
		$data['email'] = gpc_get('email','');
		$data['nick'] = gpc_get("nick","");
		$data['password'] = gpc_get("pwd","");
		
		$res = $this->getUserServ()->createUser($data);

		if($res['result']){
			$this->updateUserLoginInfo($user['data']);
			$res['BACK_URL'] = isset($_SESSION['BACK_URL'])?$_SESSION['BACK_URL']:'/';
		}
		return $this->echoMessage($res['result'],$res['message']);
	}
	
	

}

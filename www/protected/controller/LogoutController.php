<?php
/**
 * MainController
 * Feel free to delete the methods and replace them with your own code.
 *
 * @author darkredz
 */
Doo::loadClassAt("Base/AppController");
class LogoutController extends AppController{
	
	public function beforeRun($resource, $action){
		parent::beforeRun($resource, $action);
		$this->vdata['title'] = "登出-".$this->vdata['title'];
	}

	public function index(){
		session_destroy();
		if($this->isAjax()){
			echo json_encode(array('success'=>true,'BACK_URL'=>"/"));
		}else{
			header("Location:/");
		}
	}

}
?>
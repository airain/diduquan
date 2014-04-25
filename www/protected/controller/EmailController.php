<?php
/**
 * MainController
 * Feel free to delete the methods and replace them with your own code.
 *
 * @author darkredz
 */
Doo::loadClassAt("Base/AppController");
class EmailController extends AppController{
	
    public function index(){
    	//$this->vdata['script'] = "";
    	//$this->viewRenderAutomation();
    	return 404;
    }
    
    public function checkSession(){
    	session_start();
    }
    
    public function unsubscribe(){
    	
    	$submit = gpc_get("submit",false);
    	$valid = false;
    	
    	if($submit){
    		$email = gpc_get("email","");
    		$code = gpc_get("code","");
    		$res = $this->checkEmail($email, $code);
    		if($res){
    			$this->vdata['nick'] = $res->nick;
    			//cancel email
    			$unemailObj = new EmailUnsubscribe();
    			$unemailObj->email = $email;
    			$unemailObj->insert();
    			
    		}
    		$this->vdata['email'] = $email;
    		$this->vdata['code'] = $code;
    	}else{
    		$email = isset($this->params['email'])?$this->params['email']:'';
    		$code = isset($this->params['code'])?$this->params['code']:'';
    		$res = $this->checkEmail($email, $code);
    		if($res){
    			$this->vdata['nick'] = $res->nick;
    			$valid = true;
    		}
    		$this->vdata['email'] = $email;
    		$this->vdata['code'] = $code;
    	}
    	
    	$this->vdata['valid'] = $valid;
    	$this->vdata['script'] = "";
    	$this->viewRenderAutomation();
    }
    
    private function checkEmail($email,$code){
    	$res = false;
    	if($email&&$code){
    		//check email
    		$emailObj = new Email();
    		$emailObj->email = $email;
    		$emailObj->md5 = $code;
    		$res = $emailObj->getOne();
    	}
    	return $res;
    }

}
?>
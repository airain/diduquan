<?php
/**
 * LoginController
 * 登录
 */
Doo::loadClass("ModuleController");
class LoginController extends ModuleController{

	public function beforeRun($resource, $action){
        $this->vdata['module_name'] = "登录";
		parent::beforeRun($resource, $action);
	}

    public function index(){

		$this->viewRenderAutomation();
    }

    /**
     * fun: ajax
     *
     * @return void
     * @author
     **/
    public function ajax()
    {
        $email = gpc_get('email');
        $password = gpc_get('password');

        if($email==""){
            return $this->echoMessage(0,"请输入邮箱地址");
        }
        //邮箱格式
        $match = '';
        $email = mb_strtolower(trim($email));
        if(!preg_match("/^[\.\-\_\+0-9a-z]{2,}@([a-z0-9\-\_]+\.)+[a-z]{2,}$/i",$email,$match)){
            return $this->echoMessage(0,"请输入正确格式的电子邮件");
        }

        if($password==""){
            return $this->echoMessage(0,"请输入密码");
        }

        $userObj = $this->model("User");
        $conf = array(
            'where' => 'email=?',
            'param' => array($email)
        );
        $userinfo = $userObj->getOne($conf);

        if(!$userinfo || $userinfo->password != md52($password)){
            $res['BACK_URL'] = '/admin/login/';
            return $this->echoMessage(0,"登录失败", $res);
        }
        $res['BACK_URL'] = '/admin/main/';
        $this->updateUserSession($userinfo);
        $this->updateUserInfo($userinfo);
        return $this->echoMessage(1, $userinfo, $res);

    }

    private function updateUserInfo($userinfo)
    {
        $conf = array(
            'where' => 'id=?',
            'param' => array($userinfo->id)
        );
        $data = array(
            'last_time' => time(),
            'last_ip' => $this->clientIP()
        );

        $userObj = $this->model("User", $data)->update($conf);
    }
}
?>
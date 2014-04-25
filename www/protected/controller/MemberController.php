<?php
/**
 * MainController
 * Feel free to delete the methods and replace them with your own code.
 *
 * @author darkredz
 */
Doo::loadClassAt("Base/BaseController");
class MemberController extends BaseController{

	private $_m_uid = 0;
	private $_userServ = null;

	public function beforeRun($resource, $action){
		parent::beforeRun($resource, $action);
		if(!$this->isLogin()){
			header("location:/login");
		}
		$this->_m_uid = isset($this->_user)?$this->_user->uid : 1;

		Doo::loadService("UserService");
		$this->_userServ = new UserService();
	}
	
	public function index(){    	
		$this->vdata['title'] = "会员中心";
		//用户信息
		$uid = $this->_m_uid;
		//我参加的活动
		Doo::loadService('ActivityService');
		$actServ = new ActivityService();
		$cond = array(
			'where'=>'uid=?',
			'param'=>array($uid),
			'desc'=>'aoid',
			'limit'=>3
		);
		$this->vdata['actList'] = $actServ->getActOrderObj()->find($cond);
		
		//我参加的试用
		Doo::loadService('ProductService');
		$proServ = new ProductService();
		$cond = array(
			'where'=>'uid=?',
			'param'=>array($uid),
			'desc'=>'paid',
			'limit'=>3
		);
		$this->vdata['proList'] = $proServ->getProApplyObj()->find($cond);

		$this->viewRenderAutomation();
	}

	/**
	 * fun: invite
	 *
	 * @return void
	 * @author 
	 **/
	public function invite()
	{
		$this->vdata['title'] = "邀请好友-会员中心";
		Doo::loadClassAt('Security');
		$str = $this->_user->uid.'|'.$this->_user->nick;
		$secret_str = Security::EncodeString($str, Doo::conf()->SECRET_KEY);
		$this->vdata['invite_url'] = Doo::conf()->HOST.'/invites/'.$secret_str.'/'.$this->_user->uid;
		$this->viewRenderAutomation();
	}

	/**
	 * fun: message
	 *
	 * @return void
	 * @author 
	 **/
	public function message()
	{
		$this->vdata['title'] = "我的消息-会员中心";
		$uid = $this->_user->uid;
		$msgList = $this->_userServ->getMessageList($uid);
		$this->vdata['msglist'] = $msgList;
		// $this->_userServ->sendMessage(2,1,'这个活动不错 @幸福一家子 我们一起去参加吧.');
		$this->viewRenderAutomation();
	}

	/**
	 * fun: friends
	 *
	 * @return void
	 * @author 
	 **/	
	public function friends()
	{
		$this->vdata['title'] = "我的好友-会员中心";
		$friList = $this->_userServ->myfriends($this->_user->uid);
		$this->vdata['friList'] = $friList;

		$this->viewRenderAutomation();
	}

	/**
	 * fun: baseinfo
	 *
	 * @return void
	 * @author 
	 **/
	public function baseinfo()
	{
		$this->vdata['title'] = "我的资料-会员中心";
		
		$userServ = $this->_userServ;

		$conf = array(
			'where' => 'uid=?',
			'param' => array($this->_user->uid)
		);
		$this->vdata['userbaby'] = $userServ->getUserBabyObj()->getOne($conf);

		Doo::loadService("RuleService");
		$ruleServ = new RuleService();
		$rulelist = $ruleServ->getRuleRecordObj()->find($conf);

		$this->vdata['rulelist'] = $rulelist;

		$this->viewRenderAutomation();
	}

	/**
	 * fun: comment
	 * des: 评论
	 *
	 * @return void
	 * @author 
	 **/
	public function comment()
	{
		$this->vdata['title'] = "我的评论-会员中心";
		Doo::loadService('ActivityService');
		$actServ = new ActivityService();
		$limit = $start = $lasttime = 0;
		$cmtlist = $actServ->getComments(1, $this->_user->uid, $limit, $start, $lasttime);

		$this->vdata['cmtlist'] = $cmtlist;
		
		$this->viewRenderAutomation();
	}

	/**
	* fun: activity
	* des: 我的活动
	*/
	 public function activity(){
		$this->vdata['title'] = "我的活动-会员中心";
		Doo::loadService('ActivityService');
		$actServ = new ActivityService();
		$conf = array(
			'where'=>'uid='.$this->_user->uid
		);
		$myActlist = $actServ->getActOrderObj()->find($conf);
		
		$this->vdata['myactlist'] = $myActlist;

		$this->viewRenderAutomation();
	}

	/**
	* fun: acttopic
	* des: 活动报告
	*/
	 public function acttopic(){
		$this->vdata['title'] = "活动话题-会员中心";
		
		$this->viewRenderAutomation();
	}


	/**
	* fun: tries
	* des: 我参加的试用
	*/
	 public function tries(){
		$this->vdata['title'] = "我参加的试用-会员中心";
		
		$this->viewRenderAutomation();
	}

	/**
	* fun: trytopics
	* des: 我的试用报告
	*/
	 public function trytopics(){
		$this->vdata['title'] = "我的试用报告-会员中心";
		
		$this->viewRenderAutomation();
	}

	/**
	* fun: save_pic
	* des: 保存上传头像
	*/
	 public function save_pic(){
		Doo::loadClassAt('BaseGdImage');
		$path = Doo::conf()->USER_AVATAR_PATH;
		$size = Doo::conf()->USER_AVATAR_SIZES;
		$imgObj = new BaseGdImage($path, $path);

		$filename = $_FILES['filename'];
		$imgpath = $imgObj->uploadImages($filename);
		if(!$imgpath){
			echo 'error';
			return ;
		}
		$imgsizes = $imgObj->issueThumb($imgpath, $size);

		$userServ = $this->_userServ;
		$uid = $this->_user->uid;
		$data['avatar'] = $imgpath;
		$conf = array(
			'where' => 'uid=?',
			'param' => array($uid)
		);
		$res = $userServ->getUserObj($data)->update($conf);
		if($res){
			echo "ok";
		}
	}

	//---------------------- ajax -------------------
	/**
	 * fun: ajax_save
	 * des: 保存信息
	 *
	 * @return void
	 * @author 
	 **/
	public function ajax_save()
	{
		$op = gpc_get('op');
		switch ($op) {
			case 'baseinfo':
				$this->ajaxBasename($_POST);
				break;
			case 'contact':
				$this->ajaxContact($_POST);
				break;
			case 'modpwd':
				$this->ajaxModpwd($_POST);
				break;
			case 'savemsg'://发消息
				# code...
				$this->ajaxSaveMsg($_POST);
				break;
			default:
				# code...
				break;
		}
	}

	/**
	 * fun: baseinfo
	 *
	 * @return void
	 * @author 
	 **/
	private function ajaxBasename($params)
	{
		$uid = $this->_user->uid;
		$udata['gender'] = $params['gender'];
		$data['baby_state'] = $params['bstate'];
		$data['baby_name'] = $params['bname'];
		$data['baby_birth'] = $params['bbirth'];
		$data['baby_sex'] = $params['bsex'];

		$userServ = $this->_userServ;

		$conf = array(
			'where' => 'uid=?',
			'param' => array($uid)
		);
		$userServ->getUserObj($udata)->update($conf);
		if($userServ->getUserBabyObj()->getOne($conf)){
			$res = $userServ->getUserBabyObj($data)->update($conf);
		}else{
			$data['uid'] = $uid;
			$res = $userServ->getUserBabyObj($data)->insert();
		}

		if($res){
			return $this->echoMessage(1, 'ok');
		}
		return $this->echoMessage(0,'error');
	}

	/**
	 * fun: ajaxContact
	 *
	 * @return void
	 * @author 
	 **/
	private function ajaxContact($params){
		$uid = $this->_user->uid;
		$data['realname'] = $params['realname'];
		$data['mobile'] = $params['mobile'];
		$data['address'] = $params['address'];
		$data['postcode'] = $params['postcode'];

		$userServ = $this->_userServ;

		$conf = array(
			'where' => 'uid=?',
			'param' => array($uid)
		);
		$res = $userServ->getUserObj($data)->update($conf);
		if($res){
			return $this->echoMessage(1, 'ok');
		}
		return $this->echoMessage(0,'error');
	}

	/**
	 * fun: ajaxModpwd
	 *
	 * @return void
	 * @author 
	 **/
	private function ajaxModpwd($params){
		$uid = $this->_user->uid;

		if(Security::Encrypt($params['old	pwd'], Doo::conf()->SECRET_KEY) != $this->_user->pwd){
			return $this->echoMessage(0,'原始密码不对');
		}
		$data['pwd'] = Security::Encrypt($params['newpwd'], Doo::conf()->SECRET_KEY);

		$userServ = $this->_userServ;

		$conf = array(
			'where' => 'uid=?',
			'param' => array($uid)
		);
		$res = $userServ->getUserObj($data)->update($conf);
		if($res){
			return $this->echoMessage(1, 'ok');
		}
		return $this->echoMessage(0,'error');
	}

	/**
	 * fun: ajaxSaveMsg
	 *
	 * @return void
	 * @author 
	 **/
	private function ajaxSaveMsg($params)
	{
		$res = array('result'=>0, 'message'=>'error');
		$username = trim($params['username']);
		$content = trim($params['content']);
		if(empty($username)){
			$res['message'] = '您这是要给谁发呀';
			return $this->echoMessage($res['result'],$res['message'], $res);
		}
		if(empty($username)){
			$res['message'] = '您要告诉对方什么话呀';
			return $this->echoMessage($res['result'],$res['message'], $res);
		}

		$userServ = $this->_userServ;
		$conf = array(
			'where' => 'nick=?',
			'param' => array($username)
		);
		$toUserinfo = $userServ->getUserObj()->getOne($conf);
		if(!$toUserinfo){
			$res['message'] = '没有找到该好友哦';
			return $this->echoMessage($res['result'],$res['message'], $res);
		}
		if($toUserinfo->uid == $this->_user->uid){
			$res['message'] = '不能给自己发消息哦ˇˍˇ';
			return $this->echoMessage($res['result'],$res['message'], $res);
		}

		$res = $userServ->sendMessage($this->_user->uid, $toUserinfo->uid, $content);
		if(!$res['result']){
			$res['message'] = '发送失败啦';
			return $this->echoMessage($res['result'],$res['message'], $res);
		}

		$this->echoMessage($res['result'],$res['message'], $res);
	}

}

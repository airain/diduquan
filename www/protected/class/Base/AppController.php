<?php

/**
 * AppController
 * @author hxf
 *
 */
class AppController extends DooController {

	/**
	 * Module eg:admin
	 */
	private $module;

	/**
	 * Controller Name
	 */
	private $resource;

	/**
	 * Method Name
	 */
	private $action;

	/**
	 * Error
	 */
	public $error = array();

	/**
	 * Mailer
	 */
	private $mailer = null;

	/**
	 * Loger
	 */
	private $loger = null;

	/**
	 * BeanStalk
	 */
	private $beanStalk = null;

	/**
	 * LayOut
	 */
	private $layOut = "default";

	/**
	 * @param string $resource Controller Name
	 * @param string $action Method Name
	 * @see DooController::beforeRun()
	 */
	public function beforeRun($resource, $action){
		parent::beforeRun($resource, $action);

		//验证session
		$this->checkSession();

		//自动渲染
		//$this->autorender = true;

		$this->vdata['title'] = Doo::conf()->SITE_TITLE;
		$this->vdata['staticurl'] = Doo::conf()->SITE_STATIC;
		$resource = explode("Controller", $resource);
		$this->resource = my_strtolower($resource[0]);;
		$this->action = my_strtolower($action);
		$this->module = isset(Doo::conf()->MODULE)?Doo::conf()->MODULE:"";
		$this->vdata['script'] = "page/".$this->resource."/".$action;
		Doo::conf()->AUTO_VIEW_RENDER_PATH = array($this->resource,$this->action);
	}

	/**
	 * checkSession
	 * 验证session方法，可覆盖
	 */
	public function checkSession(){

	}

	/**
	 *
	 * @param int $current
	 * @param int $totalNum
	 * @param int $pageSize
	 * @return pager html
	 */
	public function pagination($current,$totalNum,$pageSize=10){
		$url = explode("?", get_cur_url());
		$url = $url[0];
		$params = gpc_strip_slashes( $_GET)+gpc_strip_slashes( $_POST);
		unset($params['p']);
		$params = http_build_query($params+array("p"=>""));
		$url = $url."?".$params;
		Doo::loadHelper('DooPager');
		$pager = new DooPager($url, $totalNum, $pageSize, 10);
		$this->vdata['pager'] = $pager->paginate($current);
		return $output;
	}

	public function renderc($file, $data=NULL, $enableControllerAccess=True, $includeTagClass=True){
		if($this->layOut){
			ob_start();
		}
		parent::renderc($file, $data, $enableControllerAccess, $includeTagClass);
		if($this->layOut){
			$data['_OUTPUT'] = ob_get_clean();
			parent::renderc("layout/".$this->layOut, $data, $enableControllerAccess, $includeTagClass);
		}
	}

	/**
	 * 打印日志
	 * @param string $msg
	 */
	public function dbLog($type, $message="", $did=0){
		if(!$this->loger){
			$this->loger = new Log();
		}
		$this->loger->type = $type;
		$this->loger->did = $did;
		$this->loger->message = $message;
		$this->loger->uri = ($this->module?"/".$this->module:"")."/".$this->resource."/".$this->action;
		$this->loger->insert();
		return $message;
	}

	Protected function setLayOut($name){
		$this->layOut = $name;
	}

	/**
	 * 调用moduel
	 * @param string $modelName
	 * @param array $param
	 */
	public function callModel($modelName, $method ,$condition=array() ,$opt=array()){
		try {
			Doo::loadModel($modelName);
			$obj = new $modelName();
		} catch (Exception $e) {
			return false;
		}
		foreach($condition as $k => $v){
			if(property_exists($obj,$k)){
				$obj->$k = $v;
			}
		}
		$args_str = '$opt';
		$args = func_get_args();
		for($i=4;$i<func_num_args();$i++){
			$args_str .= ',$args['.$i.']';
		}
		return eval('return $obj->$method('.$args_str.');');
	}


	/**
	 * 调用moduel
	 * @param string $modelName
	 * @param array $param
	 */
	public function model($modelName,$properties=array()){
		try {
			Doo::loadModelAt($modelName);
			return $obj = new $modelName($properties);
		} catch (Exception $e) {
			return false;
		}
	}

	/**
	 * 发送邮件
	 * @param string/array $to & array($to, $name)
	 * @param string $subject
	 * @param string $content
	 * @return boolean
	 */
	public function sendMail($to, $subject='', $content='', $proxy="qq"){
		if(!$this->mailer){
			Doo::loadClassAt('SendEmail');
			$this->mailer = new SendEmail();
			if($proxy == "local"){
				$this->mailer->setDelivery('postfix');
			}
		}

		list($to,$name) = is_array($to)?array_merge($to,array("","")):array($to,"");
		$content = str_replace(array("{from}"),array($this->mailer->_mail->From),$content);

		$res = false;
		try{
			$this->mailer->sendto($to, $name);
			$res = $this->mailer->SendEmail($subject, $content);
		}catch(exception $e){}
		$this->mailer->clearSendto();
		return $res;

	}

	function putQueue($settings){

		$settings = array_merge(array(
				'name' => '',
				'type' => '',
				'method' => '',
				'module' => '',
				'param' => array()
		), $settings);

		//验证name
		if($settings['name']==""){
			$this->error[] = "queue: name is not null";
			return false;
		}

		//验证type
		$settings['type'] = ucfirst($settings['type']);
		if(!in_array($settings['type'],array("Controller","Service","Class","Model"))){
			$this->error[] = "queue: type is invalid";
			return false;
		}

		//验证method
		if($settings['method']==""){
			$this->error[] = "queue: method is not null";
			return false;
		}

		//验证module
		if($settings['module']!="" && !in_array($settings['module'], Doo::conf()->MODULES)){
			$this->error[] = "queue: module is invalid";
			return false;
		}

		if(!$this->beanStalk){
			Doo::loadClassAt("PBeanStalk");
			$this->beanStalk = new PBeanStalk();
		}
		$this->beanStalk->use_tube(Doo::conf()->BEANSTALK_MULTI_NAME);
		$this->beanStalk->put(0, 0, 120, serialize($settings));

		return true;

	}

	/**
	 * 返回json统一数据格式
	 * @author huxf
	 * @version 3.3.4
	 * @param $result int 消息编号 默认为 0 （错误）
	 * @param $message string 消息内容
	 * @param $data string|int|array 扩张数据 会覆盖result、message
	 */
	protected function echoMessage($result, $message, $data=array()){
		$res = getMessage($result, $message, $data);
		$res['referurl'] = isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER'] : $_SERVER['REQUEST_URI'];
		echo json_encode($res);
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
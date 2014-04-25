<?php

/**
 * BaseScript
 * 脚本基类 
 * @author 	huxf
 * @createtime	2013-08-08
 */
Doo::loadClassAt("Base/AppController");
class BaseScript extends AppController{

	public $scriptName = "";

	public function __construct($scriptName){
		$this->scriptName = $scriptName;
		set_time_limit(0);
		error_reporting(E_ERROR | E_WARNING | E_PARSE);
		$this->log("======== ".$this->scriptName." statr ========= ");
	}

	public function __destruct(){
		$this->log("======== ".$this->scriptName." end   ========= ");
	}

	public function log($message, $prefix=""){
		if(!$prefix){
			$prefix = $this->scriptName;
		}
		if(is_array($message)){
			$message = print_r($message,true);
		}
		echo $message = date("Y-m-d H:i:s").": ".$message."\n";
		//日志放在本文件所在目录
		$log_path = Doo::conf()->LOG_PATH;
		if (!is_dir($log_path)) @mkdir($log_path, 0777, true);
		$log_path .= $prefix ."_". date('Ym', time()) . ".log";
		//写入日志文件
		error_log($message, 3, $log_path); //注：linux时，只\n即可
	}
}
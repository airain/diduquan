<?php
class LtLogger extends DooLog{
	
	public $conf = array();
	
	function __construct($debug=true){
		parent::__construct($debug);
	}
	
	public function log($msg,$level=3, $category='top'){
		$filename = "log.xml";
		if(isset($this->conf['log_file'])&&$this->conf['log_file']){
			$filename = str_replace(".log",".xml",substr($this->conf['log_file'], strrpos($this->conf['log_file'],"/")));
		}
		parent::log(json_encode($msg),$level,$category);
		parent::writeLogs($filename);
	}
	
}
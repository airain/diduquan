<?php
/**
 * v3.2.7 脚本模板
 * @author 	huxf
 * @createtime	2013-07-22
 * @command		php /data/website/topka_wb/app/protected/tasks/_template.php
 *
 */

include substr(__FILE__,0,stripos(dirname(__FILE__),"script")+7)."task.conf.php";
Doo::loadClass("Base/BaseScript");
class _ScriptClass extends BaseScript{

	public function run(){
		//TODO 
		$this->log("run");
	}

}

$myClass = new _ScriptClass(basename(__FILE__,".php"));
$myClass->run();
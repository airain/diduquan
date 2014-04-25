<?php
define('DOO_TASK_IN', true);
set_time_limit(0);
ini_set('max_execution_time', '0');

define('ROOT_PATH', str_replace("\\", "/", realpath(dirname(__FILE__)."/../../..")));

$_SERVER['DOCUMENT_ROOT'] = ROOT_PATH."/app";
$_SERVER['HTTP_HOST'] = "http://app.com";
$_SERVER['REQUEST_METHOD'] = 'GET';
// $_SERVER['REQUEST_URI'] = trim($uri);

include ROOT_PATH.'/app/protected/config/common.conf.php';

//修补配置
$config['SITE_PATH'] = ROOT_PATH.'/app/';
$config['BASE_PATH'] = ROOT_PATH.'/dooframework/';
$config['SUBFOLDER'] = str_replace($_SERVER['DOCUMENT_ROOT'], '', str_replace('\\','/',$config['SITE_PATH']));
if(strpos($config['SUBFOLDER'], '/')!==0){
	$config['SUBFOLDER'] = '/'.$config['SUBFOLDER'];
}
$config['LOG_PATH'] = $config['SITE_PATH'].'logs/';

// include ROOT_PATH.'/app/protected/config/routes.conf.php';
include ROOT_PATH.'/app/protected/config/db.conf.php';
// include ROOT_PATH.'/app/protected/config/top.conf.php';

include $config['BASE_PATH'].'Doo.php';
include $config['BASE_PATH'].'app/DooConfig.php';

spl_autoload_register('Doo::autoload');
//Doo::autoload();


Doo::conf()->set($config);

function canRun($file,$restart = false){
	$lockfile = sys_get_temp_dir().'/'.$file.'.lock';
	$pid = null;
	if(file_exists($lockfile)) $pid = file_get_contents($lockfile);
	if ($pid==null || posix_getsid($pid) === false){
		file_put_contents($lockfile,getmypid());
		return true;
	}
	if($restart){
		posix_kill($pid,9);
		return true;
	}
	return false;
}


?>
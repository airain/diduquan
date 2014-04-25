<?php
include './protected/common/common.func.php';
include './protected/config/common.conf.php';
include './protected/config/routes.conf.php';
include './protected/config/db.conf.php';
include './protected/config/top.conf.php';

#Just include this for production mode
//include $config['BASE_PATH'].'deployment/deploy.php';
include $config['BASE_PATH'].'Doo.php';
include $config['BASE_PATH'].'app/DooConfig.php';

# Uncomment for auto loading the framework classes.
spl_autoload_register('Doo::autoload');
// Doo::autoload();

Doo::conf()->set($config);

if(Doo::conf()->APP_MODE=="prod"){
	//error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
	error_reporting(E_ERROR | E_WARNING | E_PARSE );
	//error_reporting(0);
}

# remove this if you wish to see the normal PHP error view.
// include $config['BASE_PATH'].'diagnostic/debug.php';

# database usage
//Doo::useDbReplicate();	#for db replication master-slave usage
Doo::db()->setMap($dbmap);
Doo::db()->setDb($dbconfig, $config['APP_MODE']);
Doo::db()->sql_tracking = true;	#for debugging/profiling purpose

Doo::app()->route = $route;

# Uncomment for DB profiling
// Doo::logger()->beginProfile('doowebsite');
Doo::app()->run();
// Doo::logger()->endProfile('doowebsite');
// Doo::logger()->rotateFile(20);
// Doo::logger()->writeProfiles();
?>
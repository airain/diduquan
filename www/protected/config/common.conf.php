<?php
/*
 * Common configuration that can be used throughout the application
 * Please refer to DooConfig class in the API doc for a complete list of configurations
 * Access via Singleton, eg. Doo::conf()->BASE_PATH;
 */
error_reporting(E_ALL | E_STRICT);
date_default_timezone_set('Asia/Shanghai');

/**
 * for benchmark purpose, call Doo::benchmark() for time used.
 */
//$config['START_TIME'] = microtime(true);

$config['SITE_STATIC'] = '/assets';
$config['SITE_TITLE'] = '飞+';
$config['HOST_NAME'] = $_SERVER['HTTP_HOST'];
$config['HOST'] = "http://".$config['HOST_NAME'];


//For framework use. Must be defined. Use full absolute paths and end them with '/'      eg. /var/www/project/
$config['SITE_PATH'] = realpath('.').'/';//.'/app/';
// $config['PROTECTED_FOLDER'] = 'protected/';
$config['PROTECTED_DIR'] = $config['SITE_PATH'].'protected/';
$config['CONFIG_DIR'] = $config['PROTECTED_DIR'].'config/';
$config['COMMON_DIR'] = $config['PROTECTED_DIR'].'common/';
$config['BASE_PATH'] = realpath('..').'/dooframework/';

//for production mode use 'prod'
$config['APP_MODE'] = 'prod';

//----------------- optional, if not defined, default settings are optimized for production mode ----------------
//if your root directory is /var/www/ and you place this in a subfolder eg. 'app', define SUBFOLDER = '/app/'

$config['SUBFOLDER'] = str_replace($_SERVER['DOCUMENT_ROOT'], '', str_replace('\\','/',$config['SITE_PATH']));
if(strpos($config['SUBFOLDER'], '/')!==0){
	$config['SUBFOLDER'] = '/'.$config['SUBFOLDER'];
}

$config['APP_URL'] = 'http://'.$_SERVER['HTTP_HOST'].$config['SUBFOLDER'];
$config['AUTOROUTE'] = TRUE;
$config['DEBUG_ENABLED'] = TRUE;

$config['TEMPLATE_COMPILE_ALWAYS'] = TRUE;

//register functions to be used with your template files
$config['TEMPLATE_GLOBAL_TAGS'] = array('url', 'url2', 'time', 'isset', 'empty');

/**
 * Path to store logs/profiles when using with the logger tool. This is needed for writing log files and using the log viewer tool
 */
$config['LOG_PATH'] = $config['SITE_PATH'].'logs/';


/**
 * defined either Document or Route to be loaded/executed when requested page is not found
 * A 404 route must be one of the routes defined in routes.conf.php (if autoroute on, make sure the controller and method exist)
 * Error document must be more than 512 bytes as IE sees it as a normal 404 sent if < 512b
 */
$config['ERROR_404_DOCUMENT'] = '404.htm';
//$config['ERROR_404_ROUTE'] = '404.htm';


/**
 * Settings for memcache server connections, you don't have to set if using localhost only.
 * host, port, persistent, weight
 * $config['MEMCACHE'] = array(
 *                       array('192.168.1.31', '11211', true, 40),
 *                       array('192.168.1.23', '11211', true, 80)
 *                     );
 */

/**
 * Defines modules that are allowed to be accessed from an auto route URI.
 * Example, we have a module in SITE_PATH/PROTECTED_FOLDER/module/example
 * It can be accessed via http://localhost/example/controller/method/parameters
 *
 * $config['MODULES'] = array('example');
 *
 */

$config['MODULES'] = array('admin');

/**
 * Unique string ID of the application to be used with PHP 5.3 namespace and auto loading of namespaced classes
 * If you wish to use namespace with the framework, your classes must have a namespace starting with this ID.
 * Example below is located at /var/www/app/protected/controller/test and can be access via autoroute http://localhost/test/my/method
 * <?php
 * namespace myapp\controller\test;
 * class MyController extends \DooController {
 *     .....
 * }
 *
 * You would need to enable autoload to use Namespace classes in index.php
 * spl_autoload_register('Doo::autoload');
 *
 * $config['APP_NAMESPACE_ID'] = 'myapp';
 *
 */

/**
 * To enable autoloading, add directories which consist of the classes needed in your application.
 *
 * $config['AUTOLOAD'] = array(
                            //internal directories, live in the app
                            'class', 'model', 'module/example/controller',
                            //external directories, live outside the app
                            '/var/php/library/classes'
                        );
*/

$config['AUTOLOAD'] = array(
	'model','top'
);

/**
 * you can include self defined config, retrieved via Doo::conf()->variable
 * Use lower case for you own settings for future Compability with DooPHP
 */
//$config['pagesize'] = 10;

//Beanstald
$config['BEANSTALK_HOSTS'] = array( '127.0.0.1:11300' );
$config['BEANSTALK_MULTI_NAME'] = "multi";
$config['BEANSTALK_MULTI_NUM'] = 5;


//Mail
 $config['EMAIL_DELIVERY'] = 'smtp';
 $config['EMAIL_SMTP_HOST'] = 'smtp.exmail.qq.com';
 $config['EMAIL_SMTP_PORT'] = '25';
 $config['EMAIL_SMTP_MODE'] = '';
 $config['EMAIL_FROM'] = 'noreply@mlosm.com';
 $config['EMAIL_FROM_NAME'] = '测试';
 $config['EMAIL_SMTP_USERNAME'] = 'noreply@mlosm.com';
 $config['EMAIL_SMTP_PASSWORD'] = '';

//后台postfix发送邮件配置
$config['POSTFIX_DELIVERY'] = 'smtp';
$config['POSTFIX_SMTP_HOST'] = '110.75.188.27';
$config['POSTFIX_SMTP_PORT'] = '25';
$config['POSTFIX_SMTP_MODE'] = '';
$config['POSTFIX_FROM'] = 'noreply@metooshow.com';
$config['POSTFIX_FROM_NAME'] = '测试';
$config['POSTFIX_SMTP_USERNAME'] = 'noreply@metooshow.com';
$config['POSTFIX_SMTP_PASSWORD'] = '';

define('APP_IMAGE_LIB','GD'); //GD or IG

//用户密码加密密钥
$config['SECRET_KEY'] = 'qinzi_20140101';

$config['IMG_PATH'] = $config['SITE_PATH'] . "assets/img/";
$config['IMG_URL'] = $config['HOST'].'/assets/img/';
$config['IMG_SIZES'] = array('200x200'=>'200x200', '500x500'=>'500x500');

$config['USER_AVATAR_PATH'] = $config['SITE_PATH'] . "assets/img/user/";
$config['USER_AVATAR_URL'] = $config['HOST'].'/assets/img/user/';
$config['USER_AVATAR_SIZES'] = array('60x60'=>'60x60','100x100'=>'100x100', '200x200'=>'200x200');


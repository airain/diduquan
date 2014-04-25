<?php 
if (!defined("TOP_SDK_WORK_DIR"))
{
	define("TOP_SDK_WORK_DIR", "/tmp/");
}

$top_config = array(
		'format' => 'json',
		'gatewayUrl' => 'http://gw.api.tbsandbox.com/router/rest',
		'tokenUrl' => 'https://oauth.tbsandbox.com/token',
		'appkey' => 'test',
		'secretKey' => 'test'
);

if($config['APP_MODE']=='prod'){
	$top_config['gatewayUrl'] = 'https://oauth.taobao.com/authorize';
	$top_config['tokenUrl'] = 'https://oauth.taobao.com/token';
	$top_config['appkey'] = '21439966';
	$top_config['secretKey'] = 'f7020c4b5457ddde625568da45bf684a';
}
//装在TOP配置
$config['TOP'] = $top_config;
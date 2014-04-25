<?php
/**
 * 关键字跟踪后台脚本 每分钟执行一次
 * @author huxf
 */
include_once dirname(__FILE__).'/task.conf.php';
Doo::loadService("KeywordService");
$serviceObj = new KeywordService();
$res = $serviceObj->getNeedCollectionKeyword();
print_r($res);
foreach($res as $k => $v){
	$settings = array(
			'name' => 'KeywordService',
			'type' => 'service',
			'method' => 'collectRanking',
			'param' => array($v['id'])
	);
	$serviceObj->putQueue($settings);
}
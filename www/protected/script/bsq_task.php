<?php

/**
 * bsq 多进程管道消费者
 * @author huxf
 */
include_once dirname(__FILE__).'/task.conf.php';

if(canRun(basename(__FILE__))){
	
	$max = Doo::conf()->BEANSTALK_MULTI_NUM;
	$current = 0;
	Doo::loadClass("PBeanStalk");
	$bs = new PBeanStalk();
	$tube = Doo::conf()->BEANSTALK_MULTI_NAME;
	$bs->watch($tube);
	
	while(1) {
		$job = $bs->reserve();
		if(empty($job)) {
			//TODO log 
			sleep(3);
			echo "no job\n";
			continue;
		}
		$params = $job->get();
		$current++;
		Doo::db()->checkConnect();
		if (($pid = pcntl_fork()) === -1) {
			//TODO log and  exit
			die("error1");
		} elseif ($pid) {
			//father process
			$bs->delete($job);
			if ($current >= $max ) {
				//blocking
				if(pcntl_wait($status) === -1) {
					//TODO log or exit
					die("error2");
				}
			}
		} else {
			//child process
			try {
				$params = unserialize($params);
				//log
				echo date("Y-m-d H:i:s").":".$params['type']." ".$params['name']." ".$params['method']." ".$params['module']." ".json_encode($params['param'])."\n";
				$type = "load".$params['type']."At";
				Doo::$type($params['name'], $params['module']?$params['module']:null);
				$obj = new $params['name']();
				$params['param'] = is_array($params['param'])?$params['param']:array($params['param']);
				call_user_func_array(array($obj,$params['method']),$params['param']);
				unset($params);
				unset($obj);
			} catch (Exception $e) {
				//TODO log
				echo print_r($e,true)."\n";
			}
			exit;
		}
	}
}
        
<?php

/**
* Class: BeanStalk
* 继承beanStalk 
* @author huxf
*/

Doo::loadClassAt("BeanStalk");

class PBeanStalk extends BeanStalk{
	
    function __construct(){
    	
    	$in_connection_settings = array(
    			'servers'       => Doo::conf()->BEANSTALK_HOSTS,
    			//'select'        => 'random peek'
    	);
    	
    	$defaults = array(
    			'servers'               => array(),
    			'select'                => 'random wait',
    			'connection_timeout'    => 0.5,
    			'peek_usleep'           => 2500,
    			'connection_retries'    => 3,
    			'auto_unyaml'           => true
    	);
    	
    	$settings = array_merge($defaults, $in_connection_settings);
    	
    	if (!sizeof($settings['servers']))
    		throw new BeanQueueNoServersSuppliedException();
    	
    	parent::__construct($settings);
    }
    
}

?>

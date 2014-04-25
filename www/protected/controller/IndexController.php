<?php
/**
 * MainController
 * Feel free to delete the methods and replace them with your own code.
 *
 * @author darkredz
 */
Doo::loadClassAt("Base/BaseController");
class IndexController extends BaseController{
	
    public function index(){
    	//$this->vdata['script'] = null;
		// Doo::loadService('RuleService');
		// $ruleServ = new RuleService();
		
		// echo md5("123abc");
		//print_r($ruleServ->getRuleObj()->show_sql());

    	Doo::loadService("ActivityService");
    	$actServ = new ActivityService();

    	$params = array(
    		'aid'=>1,
    		'uid'=>1,
    		'content'=>'活动不错'
    	);
    	// $actServ->saveActCmt($params);

		$this->vdata['huxf'] = "HUXIONGFEI";
    	$this->viewRenderAutomation();
    }

}


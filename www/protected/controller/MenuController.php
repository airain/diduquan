<?php

/**
 
* MenuController
 
* 菜单
 
*/

Doo::loadClassAt("Base/AppController");

class MenuController extends AppController{
	

	public function beforeRun($resource, $action){
		
		parent::beforeRun($resource, $action);
		$this->vdata['module_name'] = "菜单";
	
	}

		
	public function index(){
		 
		$menuObj = new Menu();
		$data = $menuObj->find(array('select'=>'id,pid,name,url,target,deep','asc'=>'sort', 'asArray'=>true));
		 
		function getChilds($id, $data){
			$childs = array();
			foreach($data as $v){
				if($v['pid'] == $id){
					if($v['deep']<3){
						$v['childs'] = getChilds($v['id'], $data);
					}
					$childs[] = $v;
				}
			}
			return $childs;
		}
	
		$data = getChilds(1, $data);
	
		//echo "<pre>";
		//print_r($data);
	
		echo json_encode($data);
		 
	}

}
?>
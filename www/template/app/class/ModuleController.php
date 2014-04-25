<?php
Doo::loadClassAt("Base/AppController");
class ModuleController extends AppController {
	
	public function beforeRun($resource, $action){
		parent::beforeRun($resource, $action);
		$this->vdata['title'] .= "-后台管理";
		$this->vdata['script'] = str_replace("page",Doo::conf()->MODULE,$this->vdata['script']);
	}
	
}
?>
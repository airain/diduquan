<?php
/**
 * _Controller_Controller
 * _name_
 */
Doo::loadClass("_AppController_");
class _Controller_Controller extends _AppController_{
	
	public function beforeRun($resource, $action){
		parent::beforeRun($resource, $action);
		$this->vdata['module_name'] = "_name_";
	}
	
    public function index(){
    	$this->vdata['s_field'] = $this->getSearchFields();
		$this->viewRenderAutomation();
    }
    
    public function create(){
    	
    	$submit = gpc_get("submit",false);
    	
    	if($submit){
    		$valid = array(
    				'success' => true,
    				'message' => "成功"
    		);
    			
    		$obj = new _table_();
    		
    		//check data 
    		foreach($this->getFields() as $k => $v){
    			if(isset($v['primary'])&&$v['primary']){
    				continue;
    			}
    			
    			$value = gpc_get($k,$v['default']);
    			
    			if(isset($v['notnull'])&&$v['notnull']&&$value==""){
    				$valid['success'] = false;
    				$valid['message'] = $v['lable']."不能为空";
    				break;
    			}
    			$obj->$k = $value;
    		}
    			
    		//insert data
    		if($valid['success']){
    			if($obj->insert()){
    				$valid['id'] = $obj->lastInsertId();
    			}else{
    				$valid['success'] = false;
    				$valid['message'] = "添加失败！";
    				$valid['sql'] = $obj->db()->show_sql();
    			}
    		}
    		
    		echo json_encode($valid);
    		
    	}else{
    		$this->vdata['field'] = $this->getFields();
    		$this->viewRenderAutomation();
    	}
    }
    
    public function update(){
    	
    	$valid = array(
    			'success' => true,
    			'message' => "成功"
    	);
    	
    	$id = intval(gpc_get("_id_",false));
    	
    	if($valid['success']&&!$id){
    		$valid['success'] = false;
    		$valid['message'] = "ID不能为空";
    	}else{
    		$obj = new _table_();
    		$obj->_id_ = $id;
    		$item = $obj->getOne();
    		if(!$item){
    			$valid['success'] = false;
    			$valid['message'] = "信息未找到";
    		}
    	}
    	
    	$submit = gpc_get("submit",false);
    	 
    	if($submit){
    		
    		//check data
    		foreach($this->getFields() as $k => $v){
    			if(isset($v['primary'])&&$v['primary']){
    				continue;
    			}
    			$value = gpc_get($k);
    			if($k=="uptime"){
    				$value = time();
    			}
    			if($value!==null){
    				if(isset($v['notnull'])&&$v['notnull']&&$value==""){
    					$valid['success'] = false;
    					$valid['message'] = $v['lable']."不能为空";
    					break;
    				}
    				$obj->$k = $value;
    			}
    		}
    		 
    		//update data
    		if($valid['success']){
    			if($obj->update()===false){
    				$valid['success'] = false;
    				$valid['message'] = "更新失败！";
    				$valid['sql'] = $obj->db()->show_sql();
    			}
    		}
    	
    		echo json_encode($valid);
    	
    	}else{
    		if(!$valid['success']){
    			return 404;
    		}
    		$this->vdata['script'] = '_jsurl_/create';
    		$this->vdata['item'] = $item;
    		$this->viewRenderAutomation();
    	}
    	
    }
    
	public function delete(){
		$valid = array(
			'success' => true,
			'message' => "成功"
		);
		$id = gpc_get("_id_",false);
		if($valid['success']&&!$id){
			$valid['success'] = false;
			$valid['message'] = "ID不能为空！";
		}
		if($valid['success']){
			$obj = new _table_();
			foreach(explode(",",$id) as $id){
				$obj->delete(array(
						'where'=>"_id_=?",
						'param'=>array($id),
				));
			}
		}
		echo json_encode($valid);
	}
    
    public function dlist(){
    	//order param
    	$order = array('_id_'=>"asc");
    	$sort = gpc_get("sort","_id_");
    	$desc = gpc_get("desc","asc");
    	$desc = in_array($desc, array('asc','desc'))?$desc:'asc';
    	
    	//page param
    	$currPage = max(1,gpc_get("p",1));
    	$pageSize = gpc_get("size",1);
    	
    	$obj = new _table_();
    	
    	//seach
    	$s_field = $this->getSearchFields();
    	$where = "1=1";
    	$param = array();
    	foreach($s_field as $k =>  $v){
    		$value = gpc_get($k);
    		if($value!==null&&$value!==""){
    			//分为：精确、左模糊、右模糊、全模糊、
    			if(isset($v['search'])&&strpos($v['search'],"%")!==false){
    				$where .= " AND ".$k." LIKE ?";
    				$param[] = str_replace('#', $value, $v['search']);
    				continue;
    			}
    			$obj->$k = $value;
    		}
    	}
    	
    	//condition
    	$condition = array(
    			"asArray"=>true,
    			"limit" =>($currPage-1)*$pageSize.",".$pageSize,
    			'select'=>'*',
    			$desc=>$sort,
    			'desc' => 'mktime',
    			'where'=>$where,
    			'param'=>$param,
    	);
    	
    	$this->vdata['list'] = $obj->find($condition);
    	$nums = $obj->count($condition);
    	
		//var_dump($obj->db()->show_sql());
    	
    	$this->pagination($currPage, $nums,$pageSize);
    	$this->viewRenderAutomation();
    }
    
    private function getSearchFields(){
    	$field = array();
    	foreach($this->getFields() as $k => $v){
    		if(isset($v['search'])&&$v['search']){
    			$field[$k] = $v;
    		}
    	}
    	return $field;
    }
    
    private function getFields(){
    	return _export_;
    }
    
   	
}
?>
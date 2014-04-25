<?php
/**
 * UserController
 * 用户
 */
Doo::loadClass("ModuleController");
class UserController extends ModuleController{

	public function beforeRun($resource, $action){
		parent::beforeRun($resource, $action);
		$this->vdata['module_name'] = "用户";
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

    		$obj = new User();

    		//check data
    		foreach($this->getFields() as $k => $v){
    			if(isset($v['primary'])&&$v['primary']){
    				continue;
    			}

    			$value = gpc_get($k,$v['default']);

    			if($k == "password"){
    				$value = md52($value);
    			}

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

    	$id = intval(gpc_get("id",false));

    	if($valid['success']&&!$id){
    		$valid['success'] = false;
    		$valid['message'] = "ID不能为空";
    	}else{
    		$obj = new User();
    		$obj->id = $id;
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

	    			if($k == "password"){
	    				if($value!=""){
	    					$value = md52($value);
	    				}else{
	    					continue;
	    				}
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
    		$this->vdata['script'] = 'admin/user/create';
    		$this->vdata['item'] = $item;
    		$this->viewRenderAutomation();
    	}

    }

	public function delete(){
		$valid = array(
			'success' => true,
			'message' => "成功"
		);
		$id = gpc_get("id",false);
		if($valid['success']&&!$id){
			$valid['success'] = false;
			$valid['message'] = "ID不能为空！";
		}
		if($valid['success']){
			$obj = new User();
			foreach(explode(",",$id) as $id){
				$obj->delete(array(
						'where'=>"id=?",
						'param'=>array($id),
				));
			}
		}
		echo json_encode($valid);
	}

    public function dlist(){
    	//order param
    	$order = array('id'=>"asc");
    	$sort = gpc_get("sort","id");
    	$desc = gpc_get("desc","asc");
    	$desc = in_array($desc, array('asc','desc'))?$desc:'asc';

    	//page param
    	$currPage = max(1,gpc_get("p",1));
    	$pageSize = gpc_get("size",1);

    	$obj = new User();

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
    	return array (
  'id' =>
  array (
    'label' => 'ID',
    'search' => '#',
    'primary' => true,
  ),
  'type' =>
  array (
    'label' => '类型',
    'search' => '#',
  ),
  'nick' =>
  array (
    'label' => '亲昵',
    'notnull' => '1',
    'search' => '%#%',
  ),
  'email' =>
  array (
    'label' => 'Email',
    'notnull' => '1',
    'search' => '%#%',
  ),
  'mobile' =>
  array (
    'label' => '手机号',
    'search' => '%#%',
  ),
  'password' =>
  array (
    'label' => '密码',
    'search' => '0',
  ),
  'tao_uid' =>
  array (
    'label' => '淘宝ID',
    'search' => '#',
  ),
  'last_time' =>
  array (
    'label' => '登录时间',
    'search' => '0',
  ),
  'last_ip' =>
  array (
    'label' => '登录IP',
    'search' => '0',
  ),
  'state' =>
  array (
    'label' => '用户状态',
    'search' => '#',
  ),
  'maker' =>
  array (
    'label' => '创建者',
    'search' => '0',
  ),
  'mktime' =>
  array (
    'label' => '创建时间',
    'search' => '0',
  ),
  'disable' =>
  array (
    'label' => '删除标记',
    'search' => '0',
  ),
);
    }


}
?>
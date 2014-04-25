<?php
/**
 * MemberController
 * 会员管理
 */
Doo::loadClass("ModuleController");
class MemberController extends ModuleController{

	public function beforeRun($resource, $action){
		parent::beforeRun($resource, $action);
		$this->vdata['module_name'] = "会员";
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

    		$obj = new QinziUsers();

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

    	$id = intval(gpc_get("uid",false));

    	if($valid['success']&&!$id){
    		$valid['success'] = false;
    		$valid['message'] = "ID不能为空";
    	}else{
    		$obj = new QinziUsers();
    		$obj->uid = $id;
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
    		$this->vdata['script'] = 'admin/member-controller/create';
    		$this->vdata['item'] = $item;
    		$this->viewRenderAutomation();
    	}

    }

	public function delete(){
		$valid = array(
			'success' => true,
			'message' => "成功"
		);
		$id = gpc_get("uid",false);
		if($valid['success']&&!$id){
			$valid['success'] = false;
			$valid['message'] = "ID不能为空！";
		}
		if($valid['success']){
			$obj = new QinziUsers();
			foreach(explode(",",$id) as $id){
				$obj->delete(array(
						'where'=>"uid=?",
						'param'=>array($id),
				));
			}
		}
		echo json_encode($valid);
	}

    public function dlist(){
    	//order param
    	$order = array('uid'=>"asc");
    	$sort = gpc_get("sort","uid");
    	$desc = gpc_get("desc","asc");
    	$desc = in_array($desc, array('asc','desc'))?$desc:'asc';

    	//page param
    	$currPage = max(1,gpc_get("p",1));
    	$pageSize = gpc_get("size",1);

    	$obj = new QinziUsers();

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
    			'desc' => 'last_time',
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
  'uid' =>
  array (
    'label' => '用户id',
    'default' => '',
    'search' => '0',
    'primary' => true,
  ),
  'nick' =>
  array (
    'label' => '用户昵称',
    'default' => '',
    'search' => '%#%',
  ),
  'pwd' =>
  array (
    'label' => '登陆密码',
    'default' => '',
    'search' => '0',
  ),
  'gender' =>
  array (
    'label' => '性别',
    'default' => '',
    'search' => '0',
  ),
  'avatar' =>
  array (
    'label' => '头像',
    'default' => '',
    'search' => '0',
  ),
  'email' =>
  array (
    'label' => '邮箱',
    'default' => '',
    'search' => '%#%',
  ),
  'realname' =>
  array (
    'label' => '真实姓名',
    'default' => '',
    'search' => '%#%',
  ),
  'mobile' =>
  array (
    'label' => '手机号',
    'default' => '',
    'search' => '0',
  ),
  'address' =>
  array (
    'label' => '地址',
    'default' => '',
    'search' => '0',
  ),
  'postcode' =>
  array (
    'label' => '邮编',
    'default' => '',
    'search' => '0',
  ),
  'isemail' =>
  array (
    'label' => '邮箱是否确认',
    'default' => '0',
    'search' => '0',
  ),
  'status' =>
  array (
    'label' => '用户状态[0正常，1停用]',
    'default' => '0',
    'search' => '0',
  ),
  'jifen' =>
  array (
    'label' => '积分',
    'default' => '0',
    'search' => '0',
  ),
  'regtime' =>
  array (
    'label' => '添加时间',
    'default' => '0',
    'search' => '0',
  ),
  'try_cnt' =>
  array (
    'label' => '申请成功次数',
    'default' => '0',
    'search' => '0',
  ),
  'try_bj_cnt' =>
  array (
    'label' => '发布报告次数',
    'default' => '0',
    'search' => '0',
  ),
  'last_ip' =>
  array (
    'label' => '登录IP',
    'default' => '0',
    'search' => '0',
  ),
  'last_time' =>
  array (
    'label' => '登录时间',
    'default' => '0',
    'search' => '0',
  ),
);
    }


}
?>

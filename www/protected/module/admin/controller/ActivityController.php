<?php
/**
 * ActivityController
 * 活动
 */
Doo::loadClass("ModuleController");
class ActivityController extends ModuleController{

	public function beforeRun($resource, $action){
		parent::beforeRun($resource, $action);
		$this->vdata['module_name'] = "活动";
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

    		$obj = new QinziActivities();

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

    	$id = intval(gpc_get("aid",false));

    	if($valid['success']&&!$id){
    		$valid['success'] = false;
    		$valid['message'] = "ID不能为空";
    	}else{
    		$obj = new QinziActivities();
    		$obj->aid = $id;
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
    		$this->vdata['script'] = 'admin/activity/create';
    		$this->vdata['item'] = $item;
    		$this->viewRenderAutomation();
    	}

    }

	public function delete(){
		$valid = array(
			'success' => true,
			'message' => "成功"
		);
		$id = gpc_get("aid",false);
		if($valid['success']&&!$id){
			$valid['success'] = false;
			$valid['message'] = "ID不能为空！";
		}
		if($valid['success']){
			$obj = new QinziActivities();
			foreach(explode(",",$id) as $id){
				$obj->delete(array(
						'where'=>"aid=?",
						'param'=>array($id),
				));
			}
		}
		echo json_encode($valid);
	}

    public function dlist(){
    	//order param
    	$order = array('aid'=>"asc");
    	$sort = gpc_get("sort","aid");
    	$desc = gpc_get("desc","asc");
    	$desc = in_array($desc, array('asc','desc'))?$desc:'asc';

    	//page param
    	$currPage = max(1,gpc_get("p",1));
    	$pageSize = gpc_get("size",1);

    	$obj = new QinziActivities();

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
    			'desc' => 'createtime',
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
  'aid' =>
  array (
    'label' => 'id',
    'default' => '',
    'search' => '0',
    'primary' => true,
  ),
  'title' =>
  array (
    'label' => '标题',
    'default' => '',
    'search' => '%#%',
  ),
  'content' =>
  array (
    'label' => '产品详细信息',
    'default' => '',
    'search' => '0',
  ),
  'sponsor' =>
  array (
    'label' => '活动主办方',
    'default' => '',
    'search' => '0',
  ),
  'pic' =>
  array (
    'label' => '产品logo',
    'default' => '',
    'search' => '0',
  ),
  'totype' =>
  array (
    'label' => '年龄段',
    'default' => '0',
    'search' => '0',
  ),
  'city' =>
  array (
    'label' => '申请区域[城市]',
    'default' => '',
    'search' => '0',
  ),
  'city_id' =>
  array (
    'label' => '城市id',
    'default' => '0',
    'search' => '0',
  ),
  'provice' =>
  array (
    'label' => '省份',
    'default' => '',
    'search' => '0',
  ),
  'province_id' =>
  array (
    'label' => '省份id',
    'default' => '0',
    'search' => '0',
  ),
  'type' =>
  array (
    'label' => '活动类型',
    'default' => '0',
    'search' => '0',
  ),
  'isfree' =>
  array (
    'label' => '是否免费[1免费，0不免费]',
    'default' => '1',
    'search' => '#',
  ),
  'used_cnt' =>
  array (
    'label' => '已用名额',
    'default' => '0',
    'search' => '0',
  ),
  'remain_cnt' =>
  array (
    'label' => '剩余名额',
    'default' => '0',
    'search' => '0',
  ),
  'b_cnt' =>
  array (
    'label' => '报名人数',
    'default' => '0',
    'search' => '0',
  ),
  'b_stattime' =>
  array (
    'label' => '报名开始时间',
    'default' => '',
    'search' => '0',
  ),
  'b_endtime' =>
  array (
    'label' => '报名截止日期',
    'default' => '',
    'search' => '0',
  ),
  'createtime' =>
  array (
    'label' => '添加时间',
    'default' => '0',
    'search' => '0',
  ),
);
    }


}
?>
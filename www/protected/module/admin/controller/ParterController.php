<?php
/**
 * ParterController
 * 商家
 */
Doo::loadClass("ModuleController");
class ParterController extends ModuleController{

	public function beforeRun($resource, $action){
		parent::beforeRun($resource, $action);
		$this->vdata['module_name'] = "商家";
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

    		$obj = new QinziParters();

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
                if($k == 'logo'){
                    $value = replaceImgUrlToSrc($value);
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
    		$obj = new QinziParters();
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
                    if($k == 'logo'){
                        $value = replaceImgUrlToSrc($value);
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
    		$this->vdata['script'] = 'admin/parter/create';
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
        $op = gpc_get('op','');
		if($valid['success']&&!$id){
			$valid['success'] = false;
			$valid['message'] = "ID不能为空！";
		}
        $f = true;
		if($valid['success']){
            switch ($op) {
                case 'ban':
                    $udata['statue'] = 1;
                    break;
                case 'unban':
                    $udata['statue'] = 0;
                    break;

                case 'del':
                    $udata['disable'] = 1;
                    break;

                default:
                    # code...
                    $f = false;
                    break;
            }
            if($f){
                $obj = new QinziParters($udata);
                $ids = trim($id,',');
                $obj->update(array(
                            'where'=>"id IN (?)",
                            'param'=>array($ids),
                    ));
            }
		}
        return $this->echoMessage($valid['success'], $valid['message'], $valid);
		// echo json_encode($valid);
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

    	$obj = new QinziParters();

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
    'label' => 'id',
    'default' => '',
    'search' => '0',
    'primary' => true,
  ),
  'username' =>
  array (
    'label' => '帐号',
    'default' => '',
    'search' => '%#%',
  ),
  'pwd' =>
  array (
    'label' => '密码',
    'default' => '',
    'search' => '0',
  ),
  'company' =>
  array (
    'label' => '公司名称',
    'default' => '',
    'search' => '%#%',
  ),
  'logo' =>
  array (
    'label' => '公司logo图',
    'default' => '',
    'search' => '0',
  ),
  'type' =>
  array (
    'label' => '公司类型',
    'default' => '',
    'search' => '0',
  ),
  'info' =>
  array (
    'label' => '公司介绍',
    'default' => '',
    'search' => '0',
  ),
  'address' =>
  array (
    'label' => '公司地址',
    'default' => '',
    'search' => '0',
  ),
  'postcode' =>
  array (
    'label' => '邮编',
    'default' => '',
    'search' => '0',
  ),
  'email' =>
  array (
    'label' => '邮箱',
    'default' => '',
    'search' => '0',
  ),
  'contact' =>
  array (
    'label' => '联系人',
    'default' => '',
    'search' => '0',
  ),
  'mobile' =>
  array (
    'label' => '联系电话',
    'default' => '',
    'search' => '0',
  ),
  'iphone' =>
  array (
    'label' => '其他联系电话',
    'default' => '',
    'search' => '0',
  ),
  'statue' =>
  array (
    'label' => '状态[0正常,1停用]',
    'default' => '0',
    'search' => '0',
  ),
  'disable' =>
  array (
    'label' => '是否删除',
    'default' => '0',
    'search' => '0',
  ),
);
    }


}
?>
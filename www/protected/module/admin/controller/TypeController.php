<?php
/**
 * TypeController
 * 类型
 */
Doo::loadClass("ModuleController");
class TypeController extends ModuleController{

    private static $typeObj = null;
	public function beforeRun($resource, $action){
		parent::beforeRun($resource, $action);
		$this->vdata['module_name'] = "类型";

        self::$typeObj = new QinziProductType();
	}

    public function index(){
        $this->vdata['s_field'] = $this->getSearchFields();
		$this->viewRenderAutomation();
    }

    public function cr_conf(){
        # code...
        $res = self::$typeObj->find(array('asc'=>'type'));
        $file = Doo::conf()->CONFIG_DIR.'type_conf.php';
        $conf_str = "<?php\n/**\n* file: type_conf.php\n* desc: 类型配置文件\n*/\n\$product_types = array();\n";
        $type_confs = array();
        if($res){
            foreach ($res as $value) {
                # code...
                $type_confs[$value->type][$value->id] = $value->name;
            }
            $conf_str .= '$product_types = '.var_export($type_confs,true).';';
        }
        file_put_contents($file, $conf_str);
        $this->echoMessage(1, '');
    }

    public function create(){

    	$submit = gpc_get("submit",false);

    	if($submit){
    		$valid = array(
    				'success' => true,
    				'message' => "成功"
    		);

    		$obj = self::$typeObj;

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

    	$id = intval(gpc_get("id",false));

    	if($valid['success']&&!$id){
    		$valid['success'] = false;
    		$valid['message'] = "ID不能为空";
    	}else{
    		$obj = self::$typeObj;
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
    		$this->vdata['script'] = 'admin/type/create';
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
			$obj = self::$typeObj;
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

    	$obj = self::$typeObj;

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
  'name' =>
  array (
    'label' => '名称',
    'default' => '',
    'search' => '%#%',
  ),
  'type' =>
  array (
    'label' => '0产品类型，1活动类型, 2年龄段',
    'default' => '0',
    'search' => '#',
  )
);
    }


}
?>
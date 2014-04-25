<?php
/**
 * TryController
 * 试用
 */
Doo::loadClass("Base/BaseController");
class TryController extends BaseController{
	
	public function beforeRun($resource, $action){
		parent::beforeRun($resource, $action);
		$this->vdata['module_name'] = "试用";
	}
	
    public function index(){
      //$this->addTestData();
      $condition = array(
        'limit' => '0,10'
      );
      $data = $this->model("QinziProducts")->find($condition);
      $this->vdata['list'] = $data;
      $this->viewRenderAutomation();
    }

    private function addTestData(){
      $data = array(
        'parter_id'=>'',  //合作商id
        'title'=>'金领冠珍护7天轻松体验计划试用礼盒免费试用',  //标题
        'type_id'=>'',  //产品类型id
        'price'=>'',  //产品价格
        'jifen'=>'',  //产品消费积分
        'reward_jifen'=>'', //试用报价奖励积分
        'totype'=>'', //参与对象[0所有，1备孕，2孕妇，3产妇，4孩子]
        'desc'=>'', //申请规则
        'content'=>'',  //产品详细信息
        'pic'=>'',  //产品logo
        'city'=>'', //申请区域[城市]
        'city_id'=>'',  //城市id
        'provice'=>'',  //省份
        'province_id'=>'',  //省份id
        'posttype'=>'', //配送方式[1包邮，2自取，3付邮]
        'used_cnt'=>'', //已用商品数[申请成功人数]
        'remain_cnt'=>'', //剩余商品数
        'b_cnt'=>'',  //申请人数
        'b_stattime'=>'', //报名开始时间
        'b_endtime'=>'',  //报名截止日期
        'bg_stattime'=>'',  //报告提交开始时间
        'bg_endtime'=>'', //报告提交截止日期
        'bg_cnt'=>'', //已提交报告数
      );
      $data = $this->model("QinziProducts",$data)->insert();
    }
    
    public function create(){
    	
    	$submit = gpc_get("submit",false);
    	
    	if($submit){
    		$valid = array(
    				'success' => true,
    				'message' => "成功"
    		);
    			
    		$obj = new QinziProducts();
    		
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
    	
    	$id = intval(gpc_get("pid",false));
    	
    	if($valid['success']&&!$id){
    		$valid['success'] = false;
    		$valid['message'] = "ID不能为空";
    	}else{
    		$obj = new QinziProducts();
    		$obj->pid = $id;
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
    		$this->vdata['script'] = 'page/try/create';
    		$this->vdata['item'] = $item;
    		$this->viewRenderAutomation();
    	}
    	
    }
    
	public function delete(){
		$valid = array(
			'success' => true,
			'message' => "成功"
		);
		$id = gpc_get("pid",false);
		if($valid['success']&&!$id){
			$valid['success'] = false;
			$valid['message'] = "ID不能为空！";
		}
		if($valid['success']){
			$obj = new QinziProducts();
			foreach(explode(",",$id) as $id){
				$obj->delete(array(
						'where'=>"pid=?",
						'param'=>array($id),
				));
			}
		}
		echo json_encode($valid);
	}
    
    public function dlist(){
    	//order param
    	$order = array('pid'=>"asc");
    	$sort = gpc_get("sort","pid");
    	$desc = gpc_get("desc","asc");
    	$desc = in_array($desc, array('asc','desc'))?$desc:'asc';
    	
    	//page param
    	$currPage = max(1,gpc_get("p",1));
    	$pageSize = gpc_get("size",1);
    	
    	$obj = new QinziProducts();
    	
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
  'pid' => 
  array (
    'label' => 'ID',
    'default' => '',
    'search' => '0',
    'primary' => true,
  ),
  'parter_id' => 
  array (
    'label' => '合作商id',
    'default' => '0',
    'search' => '0',
  ),
  'title' => 
  array (
    'label' => '标题',
    'default' => '',
    'search' => '0',
  ),
  'type_id' => 
  array (
    'label' => '产品类型id',
    'default' => '0',
    'search' => '0',
  ),
  'price' => 
  array (
    'label' => '产品价格',
    'default' => '0.00',
    'search' => '0',
  ),
  'jifen' => 
  array (
    'label' => '产品消费积分',
    'default' => '0',
    'search' => '0',
  ),
  'reward_jifen' => 
  array (
    'label' => '试用报价奖励积分',
    'default' => '0',
    'search' => '0',
  ),
  'totype' => 
  array (
    'label' => '参与对象[0所有，1备孕，2孕妇，3产妇，4孩子]',
    'default' => '0',
    'search' => '0',
  ),
  'desc' => 
  array (
    'label' => '申请规则',
    'default' => '',
    'search' => '0',
  ),
  'content' => 
  array (
    'label' => '产品详细信息',
    'default' => '',
    'search' => '0',
  ),
  'pic' => 
  array (
    'label' => '产品logo',
    'default' => '',
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
  'posttype' => 
  array (
    'label' => '配送方式[1包邮，2自取，3付邮]',
    'default' => '0',
    'search' => '0',
  ),
  'used_cnt' => 
  array (
    'label' => '已用商品数[申请成功人数]',
    'default' => '0',
    'search' => '0',
  ),
  'remain_cnt' => 
  array (
    'label' => '剩余商品数',
    'default' => '0',
    'search' => '0',
  ),
  'b_cnt' => 
  array (
    'label' => '申请人数',
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
  'bg_stattime' => 
  array (
    'label' => '报告提交开始时间',
    'default' => '',
    'search' => '0',
  ),
  'bg_endtime' => 
  array (
    'label' => '报告提交截止日期',
    'default' => '',
    'search' => '0',
  ),
  'bg_cnt' => 
  array (
    'label' => '已提交报告数',
    'default' => '0',
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
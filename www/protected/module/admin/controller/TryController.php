<?php
/**
 * TryController
 * 试用产品
 */
Doo::loadClass("ModuleController");
class TryController extends ModuleController{
  private $proServ;
	public function beforeRun($resource, $action){
		parent::beforeRun($resource, $action);
		$this->vdata['module_name'] = "试用";

    Doo::loadServiceAt('ProductService');
    $this->proServ = new ProductService();

	}

    public function index(){
    	$this->vdata['s_field'] = $this->getSearchFields();
		  $this->viewRenderAutomation();
    }
    /**
     * fun: 申请列表
     *
     * @return void
     * @author
     **/
    public function sqlist(){
      $search = gpc_get('search','');
      $where = '';
      $params = array();
      if($search){
        $stitle = gpc_get('stitle');
        if($stitle){
          $where .= ' AND a.title LIKE ?';
          $params[] = '%'.$stitle.'%';
          $this->vdata['stitle'] = $stitle;
        }
        $snick = gpc_get('snick');
        if($snick){
          $where .= ' AND b.nick LIKE ?';
          $params[] = '%'.$snick.'%';
          $this->vdata['snick'] = $snick;
        }
        $sstate = gpc_get('sstate',null);
        if($sstate != null){
          $where .= ' AND a.state=?';
          $params[] = $sstate;
          $this->vdata['sstate'] = $sstate;
        }
      }
      $proApp = $this->proServ->getProApplyObj();
      $query = 'SELECT a.*,b.nick FROM '.$proApp->_table.' a, qinzi_users b WHERE a.uid=b.uid '.$where;
      $this->vdata['list'] = $proApp->fetchAll($query, $params);
      // print_r($proApp->show_sql());exit;
      $this->viewRenderAutomation();
    }

    /**
     * des:申请操作
     *
     * @return void
     * @author
     **/
    public function opt(){
      $res = array(
        'success' => true,
        'message' => "成功"
      );
      $id = gpc_get("ids",false);
      $opt_type = gpc_get("opt_type",false);
      if($res['success']&&!$id){
        $res['success'] = false;
        $res['message'] = "ID不能为空！";
      }
      $updata = null;
      switch ($opt_type) {
        case 'agree':
          # code...
          $updata['state'] = 2;
          break;
        case 'refuse':
          $updata['state'] = 1;
          # code...
          break;
        case 'remove':
          # code...
          break;

        default:
          # code...
          break;
      }
      $conf = array(
        'where' => 'paid IN (?)',
        'param' => array($id)
      );
      $updata != null && $rec = $this->proServ->getProApplyObj($updata)->update($conf);
      return $this->echoMessage($res['result'],$res['message'], $res);
    }

    /**
     * fun: 试用报告列
     *
     * @return void
     * @author
     **/
    public function prlist()
    {
      $proTpc = $this->proServ->getProTopicObj();
      Doo::loadModelAt('QinziUsers');
      $userObj = new QinziUsers();
      $search = gpc_get('search','');
      $where = 'state=0';
      $params = array();
      if($search){
        $stitle = gpc_get('stitle');
        if($stitle){
          $where .= ' AND title LIKE ?';
          $params[] = '%'.$stitle.'%';
          $this->vdata['stitle'] = $stitle;
        }
        $snick = gpc_get('snick');
        if($snick){
          $where .= ' AND u.nick LIKE ?';
          $params[] = '%'.$snick.'%';
          $this->vdata['snick'] = $snick;
        }
      }
      $conf = array(
        'where'=>$where,
        'select'=>$proTpc->_table.'.*,u.nick',
        'filters'=>array(
          array('model'=>$userObj,
            'alias'=> 'u',
            'joinType'=>'LEFT',
            'where'=>'1'
          )
        ),
        'asArray'=>true,
        'param'=> $params
      );
      $this->vdata['list'] = $proTpc->find($conf);
      $this->viewRenderAutomation();
    }

    /**
     * fun: ptdel
     *
     * @return void
     * @author
     **/
    public function prdel()
    {
      $valid = array(
        'success' => true,
        'message' => "成功"
      );
      $id = gpc_get("prid",false);
      if($valid['success']&&!$id){
        $valid['success'] = false;
        $valid['message'] = "ID不能为空！";
      }
      if($valid['success']){
        $conf = array(
          'where'=>'prid IN (?)',
          'param'=>array(trim($id,','))
        );
        $this->proServ->getProTopicObj(array('state'=>1))->update($conf);
      }
      echo json_encode($valid);
    }

    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    public function prview()
    {
      $id = gpc_get("prid",false);
      $params[] = intval($id);

      $proTpc = $this->proServ->getProTopicObj();
      Doo::loadModelAt('QinziUsers');
      $userObj = new QinziUsers();
      $conf = array(
        'where'=>'prid = ?',
        'select'=>$proTpc->_table.'.*,u.nick',
        'filters'=>array(
          array('model'=>$userObj,
            'alias'=> 'u',
            'joinType'=>'LEFT',
            'where'=>'1'
          )
        ),
        'param'=> $params
      );
      $this->vdata['article'] = $proTpc->getOne($conf);
      $this->viewRenderAutomation();
    }

    public function create(){

    	$submit = gpc_get("submit",false);

    	if($submit){
    		$valid = array(
    				'success' => true,
    				'message' => "成功"
    		);

    		$obj = $this->proServ->getProObj();

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
          if($k == 'pic'){
              $value = replaceImgUrlToSrc($value);
          }
    			$obj->$k = $value;
    		}
        $areaid = gpc_get('areaid');
        $proviceCity = getProvinceCity($areaid);
        if(!!$proviceCity){
          $obj->city_id = $proviceCity['city_id'];
          $obj->city = $proviceCity['city'];
          $obj->province_id = $proviceCity['province_id'];
          $obj->provice = $proviceCity['provice'];
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
        $parterObj = new QinziParters();
        $parters = $parterObj->find(array('select'=>'id,company as name'));
        $this->vdata['parters'] = $parters;
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
    		$obj = $this->proServ->getProObj();
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
            if($k == 'pic'){
                $value = replaceImgUrlToSrc($value);
            }
    				$obj->$k = $value;
    			}
    		}

        $areaid = gpc_get('areaid');
        $proviceCity = getProvinceCity($areaid);
        if(!!$proviceCity){
          $obj->city_id = $proviceCity['city_id'];
          $obj->city = $proviceCity['city'];
          $obj->province_id = $proviceCity['province_id'];
          $obj->provice = $proviceCity['provice'];
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
        $parterObj = new QinziParters();
        $parters = $parterObj->find(array('select'=>'id,company as name'));
        $this->vdata['parters'] = $parters;
    		$this->vdata['script'] = 'admin/try/create';
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
			$obj = $this->proServ->getProObj();
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

    	$obj = $this->proServ->getProObj();

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
  'pid' =>
  array (
    'label' => 'pid',
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
    'search' => '%#%',
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
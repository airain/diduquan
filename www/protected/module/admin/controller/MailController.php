<?php
/**
 * MailController
 * 邮件
 */
Doo::loadClass("ModuleController");
class MailController extends ModuleController{
	
	public function beforeRun($resource, $action){
		parent::beforeRun($resource, $action);
		$this->vdata['module_name'] = "邮件";
	}
	
    public function index(){exit;
    	$this->vdata['s_field'] = $this->getSearchFields();
		//$this->viewRenderAutomation();
    }
    
    /**
     * 发送
     */
    function send(){
    	$submit = gpc_get("submit",false);
    	 
    	if($submit){
    
    		$to = explode("\n",gpc_get("to",""));
    		$title = gpc_get("title","");
    		$content = gpc_get("content","");
    
    		if(!$title){
    			echo "标题不能为空";
    			return;
    		}
    
    		if(!$content){
    			echo "内容不能为空";
    			return;
    		}
    
    		if($to){
    			 
    			set_time_limit(0);
    			//ob_start();
    			
    			$type = gpc_get("proxy","qq");
    			$interval = intval(gpc_get("interval",0));
    			$sleep = intval(gpc_get("sleep",1))*1000000;
    			
    			$validObj = new DooValidator();
    			 
    			echo ("Start ".date("Y-m-d H:i:s"))."<br/>";
    			 
    			foreach($to as $k => $v){
    				$v = trim($v);
    				echo ("send to ".$v)."<br/>";
    				if($validObj->testEmail($v)===null){
    					
    					$nick = "";
    					$md5 = "";
    					
    					//验证email库中是否存在该email
    					$emailObj = new Email();
    					$emailObj->email = $v;
    					$email = $emailObj->getOne();
    					if(!$email){
    						//insert
    						$emailObj->md5 = $md5 = md52($v);
    						$emailObj->insert();
    					}else{
    						$nick = $email->nick;
    						$md5 = $email->md5;
    					}
    					
    					$emailLogObj = new EmailLog();
    					$emailLogObj->email = $v;
    					$emailLogObj->state = 1;
    					
    					$can_send = true;
    					$message = "";
    					
    					//退订判断
    					$emailUnsubscribeObj = new EmailUnsubscribe();
    					$emailUnsubscribeObj->email = $v;
    					$unemail = $emailUnsubscribeObj->getOne();
    					if($unemail){
    						$can_send = false;
    						$message = "该用户已退订";
    					}
    					
    					//时间间隔判断
    					if($can_send && $interval>0){
    						$log = $emailLogObj->getOne(array('state'=>1,'desc'=>'mktime'));
	    					if($log && $log->mktime > time()-($interval*3600)){
		    					$can_send = false;
		    					$message = $interval."小时内，已经发送过了";
	    					}
    					}
    					
    					if($can_send){
    						//过滤$title && $content
    						$filter = array(
    							'{nick}' => $nick,
    							'{md5}' => $md5,
    							'{to}' => $v,
    							'{r_id}' => gid(),
    							'{r_content}' => createWords(rand(100, 500)),
    							'{r_bd1}' => createPunctuation(3),
    							'{r_bd2}' => createPunctuation(3),
    							'{r_bd3}' => createPunctuation(3),
    							'{r_bd4}' => createPunctuation(3)
    						);
    						
    						$_serach = array();
    						$_replace = array();
    						
    						foreach($filter as $kk => $vv){
    							$_serach[] = $kk;
    							$_replace[] = $vv;
    						}
    						
    						$title = str_replace($_serach,$_replace,$title);
    						$content = str_replace($_serach,$_replace,$content);
    						
    						//send
		    				$res = $this->sendMail(array($v, $nick), $title, $content, $type);
	    					echo (($res?'success':'failure'))."<br/><br/>";
	    					
    						//写入邮件日志
	    					$emailLogObj->type = $type;
	    					$emailLogObj->state = $res?1:0;
	    					$emailLogObj->insert();
	    					
	    					//sleep
    						usleep($sleep);
    					}else{
    						echo ($message)."<br/><br/>";
    					}
	    					
    				}else{
    					echo ("email validate failure")."<br/>";
    				}
    				//echo ob_get_clean();
    				echo str_repeat(" ", 4096);
    				ob_flush();
    				flush();
    			}
    			echo ("Complated ".date("Y-m-d H:i:s"))."<br/>";
    			 
    		}else{
    			echo "收件人不能为空";
    		}
    	}else{
    		$this->viewRenderAutomation();
    	}
    	 
    }
    
    /**
     * 导入
     */
    function import(){
    	
    	$submit = isset($_FILES['filedata']);
    	
    	if($submit){
    		$valid = array(
    				'success' => true,
    				'message' => "成功"
    		);
    		
    		var_dump($_FILES['filedata']);
    		
    		if("text/plain"!=$_FILES['filedata']['type']){
    			$valid['success'] = false;
    			$valid['message'] = "暂时只支持文本文件";
    		}
    		
    		if($valid['success']){
    			$data = file_get_contents($_FILES['filedata']['tmp_name']);
    			$data = explode("\n",$data);
    			$obj = new Email();
    			foreach($data as $k => $v){
    				$obj->email = $v;
    				$obj->md5 = md52($obj->email);
    				$obj->maker = $_SESSION['UID'];
    				$obj->mktime = time();
//     				$obj->disable
    				$obj->insert();
    			}
    		}
    		
    		echo json_encode($valid);
    		
    		
    		
//     		var_dump($data);
    		
    		
    		return;
    			
    		$obj = new Email();
    		
    		//check data 
    		foreach($this->getFields() as $k => $v){
    			if(isset($v['primary'])&&$v['primary']){
    				continue;
    			}
    			
    			$value = gpc_get($k,$v['default']);
    			
    			if($k=="maker"){
    				$value = $_SESSION['UID'];
    			}
    			
    			if($k=="mktime"){
    				$value = time();
    			}
    			
    			if(isset($v['notnull'])&&$v['notnull']&&$value==""){
    				$valid['success'] = false;
    				$valid['message'] = $v['lable']."不能为空";
    				break;
    			}
    			$obj->$k = $value;
    		}
    		
    		$obj->md5 = md52($obj->email);
    			
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
    
    function create(){
    	
    	$submit = gpc_get("submit",false);
    	
    	if($submit){
    		$valid = array(
    				'success' => true,
    				'message' => "成功"
    		);
    			
    		$obj = new Email();
    		
    		//check data 
    		foreach($this->getFields() as $k => $v){
    			if(isset($v['primary'])&&$v['primary']){
    				continue;
    			}
    			
    			$value = gpc_get($k,$v['default']);
    			
    			if($k=="maker"){
    				$value = $_SESSION['UID'];
    			}
    			
    			if($k=="mktime"){
    				$value = time();
    			}
    			
    			if(isset($v['notnull'])&&$v['notnull']&&$value==""){
    				$valid['success'] = false;
    				$valid['message'] = $v['lable']."不能为空";
    				break;
    			}
    			$obj->$k = $value;
    		}
    		
    		$obj->md5 = md52($obj->email);
    			
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
    
    function update(){
    	
    	$valid = array(
    			'success' => true,
    			'message' => "成功"
    	);
    	
    	$id = intval(gpc_get("id",false));
    	
    	if($valid['success']&&!$id){
    		$valid['success'] = false;
    		$valid['message'] = "ID不能为空";
    	}else{
    		$obj = new Email();
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
    		
    		if($obj->email){
    			$obj->md5 = md52($obj->email);
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
    		$this->vdata['script'] = 'admin/mail/create';
    		$this->vdata['item'] = $item;
    		$this->viewRenderAutomation();
    	}
    	
    }
    
	function delete(){
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
			$obj = new Email();
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
    	
    	$obj = new Email();
    	
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
    'search' => '0',
    'primary' => true,
  ),
  'type' => 
  array (
    'label' => '类型',
    'search' => '#',
  ),
  'email' => 
  array (
    'label' => 'Email',
    'notnull' => '1',
    'search' => '%#%',
  ),
  'nick' => 
  array (
    'label' => '亲昵',
    'search' => '%#%',
  ),
  'md5' => 
  array (
    'label' => 'MD5*2',
    'search' => '0',
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
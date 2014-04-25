<?php
/**
 * MainController
 * Feel free to delete the methods and replace them with your own code.
 *
 * @author darkredz
 */
Doo::loadClass("ModuleController");
class CreateAppController extends ModuleController{

    public function index(){
    	$submit = gpc_get("submit",false);
    	if($submit){
    		$valid = array(
    				'success' => true,
    				'message' => '成功'
    		);

    		$name = gpc_get("name","");
    		$module = gpc_get("module","");
    		$controller = gpc_get("controller","");
    		$table = gpc_get("table","");
    		$main = gpc_get("main","");

    		if($valid['success']&&$name==""){
    			$valid['success'] = false;
    			$valid['message'] = 'name not null';
    		}
//     		if($valid['success']&&$module==""){
//     			$valid['success'] = false;
//     			$valid['message'] = 'module not null';
//     		}
    		if($valid['success']&&$controller==""){
    			$valid['success'] = false;
    			$valid['message'] = 'controller not null';
    		}

    		$fields = gpc_get("fields",array());

    		if($valid['success']){
    			if($fields){
    				foreach($fields as $k => $v){
    					if($v['label']==""){
    						$valid['success'] = false;
    						$valid['message'] = '表字段中所有字段名都不能为空。';
    						break;
    					}
    				}
    			}else{
    				$valid['success'] = false;
    				$valid['message'] = '未获得表字段信息。';
    			}
    		}

    		if($valid['success']&&$main==""){
    			$valid['success'] = false;
    			$valid['message'] = '主字段不能为空';
    		}

    		$keytip = gpc_get("keytip","请输入搜索内容...");
    		$keytip == ""?$keytip = "请输入搜索内容...":"";

    		if($valid['success']){

    			$url = my_strtolower(($module?'/'.$module:'')."/".$controller);
    			$jsurl = my_strtolower( ($module?$module:'page')."/".$controller);

    			$_search = array(
    					'_jsurl_' => $jsurl,
    					'_url_' => $url,
    					'_name_' => $name,
    					'_table_' => str_replace(" ","",ucwords(str_replace("_"," ",$table))),
    					'_id_' => $main,
    					'_Controller_'  => ucwords($controller),
    					'_controller_'  => my_strtolower($controller),
    					'_AppController_' => $module?'ModuleController':'AppController',
    					'_export_' => array(),
    					'_form_' => "",
    					'_list_' => "",
    					'_listheader_' => '',
    					'_updateform_' => '',
    			);

    			foreach($fields as $k => $v){

    				//_export_
    				foreach ($v as $kk => $vv){
    					if(in_array($kk,array('label','search','notnull','default'))){
    						$_search['_export_'][$k][$kk] = $vv;
    					}
    				}
    				if($k==$main){
    					$_search['_export_'][$k]['primary'] = true;
    				}

    				//_form_
    				if(isset($v['formview'])&&$v['formview']){
    					if($k!=$main){
    						$_search['_form_'] .= "\t\t\t\t".'<div class="form-group">
				  <label class="col-sm-2 control-label" >'.$v['label'].'</label>
				  <div class="col-sm-10">
				    <input type="text" placeholder="'.$v['label'].'"  name="'.$k.'" value="<?php echo $item->'.$k.';?>" '.($v['notnull']?'required':'').'/>
				  </div>
				</div>'."\n";
    					}
    				}

    				//_listheader_,_list_
    				if((isset($v['listview'])&&$v['listview'])||$k==$main){
    					$_search['_listheader_'] .= '<th>'.$v['label'].'</th>';
    					if($k=="mktime"||$k=="uptime"){
    						$_search['_list_'] .= "\t\t\t\t\t\t\t\t\t".'<td><?php echo date("Y-m-d H:i:s",$v[\''.$k.'\']);?></td>'."\n";
    					}else{
    						$_search['_list_'] .= "\t\t\t\t\t\t\t\t\t".'<td><?php echo $v[\''.$k.'\'];?></td>'."\n";
    					}
    				}
    			}
    			$_search['_updateform_'] = $_search['_form_'];
    			$_search['_export_'] = var_export($_search['_export_'], TRUE);

    			$search = array();
    			$replace = array();
    			foreach ($_search as $k => $v){
    				$search[] = $k;
    				$replace[] = $v;
    			}

    			$exclude = array(".svn");
    			if(!$module){
    				$exclude[] = "ModuleController.php";
    			}

    			$root = Doo::conf()->SITE_PATH;
    			$this->copy($root."template/app", $root."protected".($module?'/module/'.$module:''),$search,$replace,$exclude);
    			$this->copy($root."template/js", $root."assets/js/".($module?$module:'page')."/".my_strtolower($controller),$search,$replace,$exclude);

    			//生成moule
    			ob_start();
    			Doo::loadCore('db/DooModelGen');
        		DooModelGen::genMySQL(true, true, 'BaseModel', false, '', null, Doo::getAppPath()."model/");
        		file_put_contents("d:/aaaaa.txt",ob_get_clean());

        		//清除autofile
	    		if(isset(Doo::conf()->PROTECTED_FOLDER_ORI)===true){
	                $path = Doo::conf()->SITE_PATH . Doo::conf()->PROTECTED_FOLDER_ORI;
	            }else{
	                $path = Doo::conf()->SITE_PATH . Doo::conf()->PROTECTED_FOLDER;
	            }
    			$autoloadFile = $path . 'config/autoload/autoload.php';
            	if(file_exists($autoloadFile)===true){
            		unlink($autoloadFile);
            	}

    			$valid['message'] = "创建成功！访问地址：<a target=\"_blank\" href=\"".$url."/index\">$url/index</a>";
    		}

    		echo json_encode($valid);

    	}else{
    		$this->viewRenderAutomation();
    	}

    }

    private function copy($from, $to, $search="", $replace="",$exclude=array()){
    	$from = str_replace("\\","/",$from);
    	$to = str_replace("\\","/",$to);
    	Doo::loadHelper("DooFile");
    	$fileHelper = new DooFile();
    	$res = $fileHelper->getList($from);
    	if(is_array($res))foreach ($res  as $k => $v){
    		if(in_array(basename($v['path']),$exclude)){
    			continue;
    		}
    		if($v['folder']){
    			$this->copy($v['path'], str_replace($from,$to,$v['path']), $search, $replace,$exclude);
    		}else{
    			$name = str_replace($from,$to,$v['path']);
    			$name = str_replace($search, $replace,$name);
    			if(!file_exists($name)){
    				$content = $fileHelper->readFileContents($v['path']);
    				$content = str_replace($search, $replace, $content);
    				$fileHelper->create($name,$content);
    			}
    		}
    	}
    }

    public function table(){
    	$valid = array(
    			'success' => true,
    			'message' => '成功'
    	);
    	$table = gpc_get("table","");
    	if($valid['success']&&$table==""){
    		$valid['success'] = false;
    		$valid['message'] = 'table  不能为空';
    	}
    	Doo::loadClassAt("Base/BaseModel");
    	$db = new BaseModel();
    	$db = $db->db();
    	if($valid['success']){
    		try {
    			//判断表是否存在
    			$result = $db->fetchRow("SHOW TABLES LIKE '".$table."'");
    		} catch (Exception $e) {}
    		if($result){
    			$this->vdata['list'] = $db->fetchAll("SHOW FULL FIELDS FROM ".$table);
    		}else{
    			echo "未找到 ".$table." 表，请检查输入。";
    		}
    	}
    	$this->vdata['message'] = $valid['message'];
    	$this->viewRenderAutomation();
    }
}
?>
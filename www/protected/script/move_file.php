<?php
function move_file_to($from_dir,$to_dir){
	$args = func_get_args();
	foreach($args as $k => $v){
		$args[$k] = str_replace("\\","/",$v);
		if($v[strlen($v)-1] != '/'){
			$args[$k] .= "/";
		}
	}
	list($from_dir,$to_dir) = $args;
	if(!is_dir($from_dir)){
		return ;
	}
	if(!is_dir($to_dir)){
		if(file_exists($to_dir)){
			return ;
		}else{
			mkdir($to_dir);
		}
	}
	echo $from_dir."\n";
	echo $to_dir."\n";
	$handle = opendir($from_dir);
	while(false !== ($file = readdir($handle))){
		if(in_array($file,array(".","..",".settings",".svn","backup",".buildpath",".project"))){
			continue;
		}
		$to_file = $to_dir.$file;
		$from_file = $from_dir.$file;
		if(is_dir($from_file)){
			//echo "in\n";
			move_file_to($from_file,$to_file);
		}else{
			if(file_exists($to_file)){
				rename($to_file,$to_file.".bak.".date("Ymdhis"));
			}
			copy($from_file,$to_file);
		}
		//echo $file."\n";
	}
	closedir($handle);
}


$root = dirname(__FILE__);

echo $root."\n\n\n";



move_file_to($root,"H:/hu.xiongfei/tmp");
<?php

function dump($var){
	echo '<pre>';
	print_r($var);
	echo '</pre>';
}

/**
 * 加key 2次md5
 * @param unknown $str
 * @param string $key
 */
function md52($str,$key="feiplus!"){
	return md5(md5($str).$key);
}

/**
 * KeyWord/IndexChar => key-word/index-char
 * @param string $str
 */
function my_strtolower($str){
	if(is_array($str)){
		return str_replace($str[1],"-".$str[1],$str[0]);
	}
	return strtolower(preg_replace_callback("/[^\/]([A-Z]{1})/", "my_strtolower", $str));
}

function cookie($key,$value=null,$expire=86400){
	if($value==null){
		return isset($_COOKIE[$key])?$_COOKIE[$key]:null;
	}else{
		return setcookie($key,$value,$expire>0?time()+$expire:0,"/",$_SERVER['HTTP_HOST']);
	}
}

function gid(){
	return md5(rand(0,9999999999));
}

function createPunctuation($words = 128){
	$words = rand(0,$words);
	$seperate = array("，","。","！","？","；","……","（","）","——","“","‘"," ","-",".");
	$strings = "";
	for ($i=0; $i<$words; $i++){
		$strings .= $seperate[rand(0, 13)];
	}
	return $strings;
}

function createWords($words = 128){
	$seperate = array("，","。","！","？","；");
	$strings = "";
	for ($i=0; $i<$words; $i++){
		$strings .= chr(rand(0xB0,0xD6)).chr(rand(0xA1,0xFE));
		if (fmod($i, 18) > rand(10, 20)){
			$strings .= $seperate[rand(0, 4)];
		}
	}
	return iconv("GBK","UTF-8",$strings);
}

function time_format($time = ""){
	return date("Y-m-d H:i:s",$time?$time:time());
}

function route2url(){

}

/*
function getModuleName(){
	$uri = $_SERVER['REQUEST_URI'];

	//remove index.php/ from the URI if exist
	if(strpos($uri, 'index.php/')===0)
		$uri = substr($uri, strlen('index.php/'));

	//strip out the GET variable part if start with /?
	if($pos = strpos($uri, '/?')){
		$uri = substr($uri,0,$pos);
	}else if($pos = strpos($uri, '?')) {
		$tmp = explode('?', $uri);
		$uri = $tmp[0];
	}

	if($uri!=='/'){
		$end = strlen($uri) - 1;
		while( $end > 0 && $uri[$end] === '/' ){
			$end--;
		}
		$uri = substr($uri, 0, $end+1);
	}

	//remove the / in the first char in REQUEST URI
	if($uri[0]==='/')
		$uri = substr($uri, 1);

	//spilt out GET variable first
	$uri = explode('/',$uri);

	$module = null;
	if(isset(Doo::conf()->MODULES)===true && in_array($uri[0], Doo::conf()->MODULES)===true){
		$module = $uri[0];
	}
	return $module;
}

function uri($controller, $method="", $module="" , $query=false, $addAppUrl=false){

	if($module==""){
		$module = getModuleName();
	}

	$url = "/";
	if($module)
		$url .= $module."/";
	$url .= $controller."/";
	if($method)
		$url .= $method."/";
	$url .= $query?"?".(is_array($query)?http_build_query($query):$query):'';
	if($addAppUrl)
		$url = Doo::conf()->APP_URL . substr($url,1);
	return $url;
}
*/

/*
 * 取得当前url
 */
function get_cur_url(){
	if(!empty($_SERVER["REQUEST_URI"])){
		$scriptName = $_SERVER["REQUEST_URI"];
		$nowurl = $scriptName;
	}else{
		$scriptName = $_SERVER["PHP_SELF"];
		if(empty($_SERVER["QUERY_STRING"])){
			$nowurl = $scriptName;
		}else{
			$nowurl = $scriptName."?".$_SERVER["QUERY_STRING"];
		}
	}
	return $nowurl;
}

/*
 * 判断系统配置，返回原始数据（去除被系统添加的转义反斜杠）
* @add by hu.xiongfei
* @date 20130313
*/
function gpc_strip_slashes( $p_var ) {
	if ( 0 == get_magic_quotes_gpc() ) {
		return $p_var;
	} else if ( !is_array( $p_var ) ){
		return stripslashes( $p_var );
	} else {
		foreach ( $p_var as $key => $value ) {
			$p_var[$key] = gpc_strip_slashes( $value );
		}
		return $p_var;
	}
}

/*
 * 获取参数，不区分post还是get，含有默认值选项
* @add by huxiongfei
* @date 20130313
* @param $p_var_name 获取属性名称
* @param $p_default 默认值
*/
function gpc_get( $p_var_name, $p_default = null ) {
	if ( isset( $_POST[$p_var_name] ) ) {
		$t_result = gpc_strip_slashes( $_POST[$p_var_name] );
	} else if ( isset( $_GET[$p_var_name] ) ) {
		$t_result = gpc_strip_slashes( $_GET[$p_var_name] );
	} else if ( func_num_args() > 1 ) { #check for a default passed in (allowing null)
		$t_result = $p_default;
	} else {
		$t_result = null;
	}
	if(is_string($t_result)){
		$t_result = trim($t_result);
	}
	return $t_result;
}

//-------------------------------------


/**
 * fun: verify_password
 * des: 检查密码
 * @param string $real_name
 * @return array A
*/
function verify_password($password)
{
	if(!isset($password) || empty($password)){
		return array('result'=>0,'message'=>'请输入密码','type'=>'password');
	}
	$strlen = strlen($password);
	if($strlen < 6 || $strlen > 20){
		return array('result'=>0,'message'=>'密码应为6～20个字符','type'=>'password');
	}
	return array('result'=>1,'message'=>'','type'=>'password');
}


/**
* fun: getContentImgs
* des: 获取内容中上传图url
*
* @param string $content
* @return array A [cnt,imgs]
*
*/
function getContentImgs($content){
	$rec = array('cnt'=>0, 'imgs'=>array());
	if (preg_match_all('/<img\s.*?src=\"(.*?)\".*?\/>/i', $content, $out)) {
		$res = array();print_r($out);
		foreach ($out[1] as $k => $v) {
			$hosts = parse_url($v);
			if($hosts['host'] == Doo::conf()->HOST_NAME){
				$rec['imgs'][] =  str_replace(Doo::conf()->HOST, '', $v);
				$rec['cnt']++;
			}
		}
	}
	return $rec;
}//getContentImgs

/**
 * 返回json统一数据格式
 * @author huxf
 * @version 3.3.4
 * @param $result int 消息编号 默认为 0 （错误）
 * @param $message string 消息内容
 * @param $data string|int|array 扩张数据 会覆盖result、message
 */
function getMessage($result, $message, $data=array()){
	$res = array(
		'result'=>$result,
		'message'=>$message,
	);
	if($data){
		$res = array_merge($res,$data);
	}
	return $res;
}

/**
 * 返回json统一数据格式
 * @author huxf
 * @version 3.3.4
 * @param $result int 消息编号 默认为 0 （错误）
 * @param $message string 消息内容
 * @param $data string|int|array 扩张数据 会覆盖result、message
 */
function echoUserAvatar($src, $size="60x60"){
	global $config;
	$src = $config['USER_AVATAR_URL'].$src;
	return str_replace("src", $size, $src);
}

/**
 * 将objects数据转换为指定key的array
 * @param type $data    findAll返回结果集
 * @param type $key     指定要设置的KEY字段名
 * @return type array
 */
function convertToArray($data, $key) {
    $array = array();
    if (!$data || empty($data))
        return $array;

    foreach ($data as $value) {
        $tmp = (array) $value;
        $array[$tmp[$key]] = $value;
    }
    return $array;
}

/**
* fun: showArray
* des: 二维数组类型
*
* @return string
* @author
*/
function showArrayType(array $ary=array(),$opt=array(), array $key=array('id','name')){
	if(count($ary) == 0 || !is_array($ary[0]) && !is_object($ary[0]))  return '';
	$data = array();
	foreach ($ary as $value) {
		if(is_array($value))
			$data[$value[$key[0]]] = $value[$key[1]];
		else
			$data[$value->$key[0]] = $value->$key[1];
	}
	$opt['data'] = $data;
	return getTypeS($opt);
}

/**
 * fun: getTypeS
 *
 * @return void|str
 * @author
 **/
function getTypeS(array $opt=array()){
	$types = array('公司类型','活动类型','年龄段','产品类型');
	$conf = array(
		'id' => '',	//id
		'type' => 'select', //显示方式[select,checkbox,radio,text]
		'checked' => '',	//默认选项
		'show' => true,	//是否显示,false:返回字符串
		'class' => '',	//样式
		'option' => '',	//select下拉框option属性
		'other' => '',	//其他属性
		'data' => $types,	//数据
	);
	$conf = array_merge($conf, $opt);
	$pro = '';
	$option = '';
	$id = '_'.$conf['type'];
	if(!empty($conf['id'])){
		$id = $conf['id'];
	}
	if(!empty($conf['class'])){
		$pro .= ' class="'.$conf['class'].'"';
	}
	if(!empty($conf['other'])){
		$pro .= ' '.$conf['other'];
	}
	if(!empty($conf['option'])){
		$option = ' '.$conf['option'];
	}
	$str = '';
	if($conf['type'] == 'select'){
		$str = '<select id="'.$id.'" name="'.$id.'"'.$pro.">\n";
		$str .= '<option value="">--请选择--</option>';
		foreach ($conf['data'] as $key => $value) {
			$checked = $conf['checked'] == $key? 'selected':'';
			$str .= '<option '.$checked.$option.' value="'.$key.'">'.$value."</option>\n";
		}
		$str .= "</select>\n";
	}elseif ($conf['type'] == 'checkbox') {
		# code...
		foreach ($conf['data'] as $key => $value) {
			$checked = $conf['checked'] == $key? 'checked':'';
			$str .= '<label class="checkbox-inline">
					<input id= "'.$id.$key.'" name="'.$id.$key.'" type="checkbox" '.$checked.$pro.' value="'.$key.'"> '.$value.
				"\n</label>\n";
		}
	}elseif ($conf['type'] == 'radio') {
		# code...
		foreach ($conf['data'] as $key => $value) {
			$checked = $conf['checked'] == $key? 'checked':'';
			$str .= '<label class="radio-inline">
				<input id="'.$id.$key.'" name="'.$id.'" type="radio" '.$checked.$pro.' value="'.$key.'"> '.$value.
				"\n</label>\n";
		}
	}elseif ($conf['type'] == 'text') {
		# code...
		$index = array_key_exists($conf['checked'], $conf['data']);
		if($index) $str = '<span>'.$conf['data'][$conf['checked']].'</span>';
		else $str = '无';
	}

	if($conf['show']) echo $str;
	else return $str;
}

/**
 * fun: getCompanyType
 * des: 公司类型
 *
 * @return void|str
 * @author
 **/
function getCompanyType(array $opt = array()){
	global $config;
	include($config['CONFIG_DIR'].'type_conf.php');
	$opt['data'] = $product_types[0];
	return getTypeS($opt);
}

/**
 * fun: getProductType
 * des: 产品类型
 *
 * @return void|str
 * @author
 **/
function getProductType(array $opt = array()){
	global $config;
	include($config['CONFIG_DIR'].'type_conf.php');
	$opt['data'] = $product_types[3];
	return getTypeS($opt);
}

/**
 * fun: getYearSection
 * des: 年龄段
 *
 * @return void|str
 * @author
 **/
function getYearSection(array $opt = array()){
	global $config;
	include($config['CONFIG_DIR'].'type_conf.php');
	$opt['data'] = $product_types[2];
	return getTypeS($opt);
}

/**
 * fun: getJoinType
 * des: 参与对象
 *
 * @return void|str
 * @author
 **/
function getJoinType(array $opt = array()){
	$opt['data'] = array('所有','备孕','孕妇','产妇','孩子');

	return getTypeS($opt);
}

/**
 * fun: getPostType
 * des: 配送方式
 *
 * @return void|str
 * @author
 **/
function getPostType(array $opt = array()){
	$opt['data'] = array('-','包邮','自取','付邮');
	return getTypeS($opt);
}

/**
 * fun: getActivityType
 * des: 活动类型
 *
 * @return void|str
 * @author
 **/
function getActivityType(array $opt = array()){
	global $config;
	include($config['CONFIG_DIR'].'type_conf.php');
	$opt['data'] = $product_types[1];
	return getTypeS($opt);
}

/**
 * fun: getProvinceCity
 * des: 根据城市获取城市与省份数据
 *
 * @return void
 * @author
 **/
function getProvinceCity($cityid=0)
{
	global $config;
	if (empty($cityid)) {
		return array();
	}
	include($config['COMMON_DIR'].'area.php');
	$city = $citysData[$cityid];
	$province_id = substr($cityid,0,2).'0000';
	$province = $provincesData[$province_id];
	$city = empty($city)?$province:$city;
	return array('city_id'=>$cityid,'city'=>$city,'province_id'=>$province_id,'province'=>$province);
}

/**
 * fun: 替换图片url
 *
 * @return void
 * @author
 **/
function replaceImgUrlToSrc($url)
{
	global $config;
	if(strpos($url, $config['IMG_URL']) === false) return $url;
	$str = str_replace($config['IMG_URL'], '', $url);
	$str = preg_replace('@[0-9]{1,3}x[0-9]{1,3}/(.*)@', 'src/$1', $str);
	return $str;
}

function getImgUrl($src, $size='200x200'){
	global $config;

	$str = str_replace('src/', $size.'/', $src);
	return $config['IMG_URL'].$str;
}

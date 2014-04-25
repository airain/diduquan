<?php
/**
 * Class: Security
 * des: 加密方式
 *
 * @author lhj
 * create_time : 2013/12/11
 */
 
class Security {
	//--------------- ios/android对等加密 start --------------------
	/*
	* fun: mEncrypt
	* des: 与ios、android 统一的des加密
	* @param string $string 被加密串
	* @param string $key 密钥
	* @return string 加密串
	*/
	public static function mEncrypt($string, $key) {

        $ivArray=array(1,2,3,4,5,6,7,8);
        $iv=null;
        foreach ($ivArray as $element)
            $iv.=CHR($element);

        $size = mcrypt_get_block_size ( MCRYPT_DES, MCRYPT_MODE_CBC ); 
        $string = self::pkcs5Pad ( $string, $size ); 
		
		$keys = self::StringSplice($key);
		foreach($keys as $v){
			$string =  mcrypt_encrypt(MCRYPT_DES, $v, $string, MCRYPT_MODE_CBC, $iv);
		}
        //$data =  mcrypt_encrypt(MCRYPT_DES, $key, $string, MCRYPT_MODE_CBC, $iv);

        return self::SetToHexString($string);
    }
   /*
	* fun: mDecrypt
	* des: 与ios、android 统一的des加密
	* @param string $string 加密串
	* @param string $key 密钥
	* @return string 被加密串
	*/
   public static function mDecrypt($string, $key) {

        $ivArray=array(1,2,3,4,5,6,7,8);
        $iv=null;
        foreach ($ivArray as $element)
            $iv.=CHR($element);

        $string = self::UnsetFromHexString($string);
		$keys = self::StringSplice($key);

		$nkeys = count($keys);
		for($i=$nkeys-1; $i >= 0; $i--){
			$string =  mcrypt_decrypt(MCRYPT_DES, $keys[$i], $string, MCRYPT_MODE_CBC, $iv);
		}
        //$result =  mcrypt_decrypt(MCRYPT_DES, $key, $string, MCRYPT_MODE_CBC, $iv);
		$result = self::pkcs5Unpad( $string ); 

        return $result;
    }
	
	private static function StringSplice($string){
		$ret = array();
		$num = 8;
		for($i=0; strlen($string) > 0;)
		{
			$ret[] = substr($string, $i, $num);
			$string = substr($string, $num, $num);
		}
		return $ret;
	}

	private static function SingleDecToHex($dec)
	{
		$tmp="";
		$dec=$dec%16;
		if($dec<10)
			return $tmp.$dec;
		$arr=array("a","b","c","d","e","f");
		return $tmp.$arr[$dec-10];
	}
	private static function SingleHexToDec($hex)
	{
		$v=ord($hex);
		if(47<$v&&$v<58)
			return $v-48;
		if(96<$v&&$v<103)
			return $v-87;
	}
	private static function SetToHexString($str)
	{
		if(!$str)return false;
		$tmp="";
		for($i=0;$i<strlen($str);$i++)
		{
			$ord=ord($str[$i]);
			$tmp.= self::SingleDecToHex(($ord-$ord%16)/16);
			$tmp.= self::SingleDecToHex($ord%16);
		}
		return $tmp;
	}
	private static function UnsetFromHexString($str)
	{
		if(!$str)return false;
		$tmp="";
		for($i=0;$i<strlen($str);$i+=2)
		{
			$tmp.=chr(self::SingleHexToDec(substr($str,$i,1))*16+self::SingleHexToDec(substr($str,$i+1,1)));
		}
		return $tmp;
	} 

	private static function pkcs5Pad($text, $blocksize)
    {
        $pad = $blocksize - (strlen ( $text ) % $blocksize);
        return $text . str_repeat ( chr ( $pad ), $pad );
    }
 
    private static function pkcs5Unpad($text)
    {
        $pad = ord ( $text {strlen ( $text ) - 1} );
        if ($pad > strlen ( $text ))
            return false;
        if (strspn ( $text, chr ( $pad ), strlen ( $text ) - $pad ) != $pad)
            return false;
        return substr ( $text, 0, - 1 * $pad );
    } 
	
	//-------------------  ios/android对等加密 end  --------------------
	
  /**
  * fun: EncodeString
  * des: 对字符串Encode处理
  * @param $string string 待加密的字符串
  * @param $salt string 用于加密的字符串，相当于私钥
  * @param $ishex bool 是否是16进制字符串形式
  * @return string Encode后的字符串
  */
	public static function EncodeString($string,$salt,$ishex=true, $mode='cfb') {
		srand((double) microtime() * 1000000); 
		$key = md5($salt); //to improve variance
		/* Open module, and create IV */
		$mode = empty($mode)?'cfb' : $mode;
		$td = mcrypt_module_open('des', '',$mode, '');
		$key = substr($key, 0, mcrypt_enc_get_key_size($td));
		$iv_size = mcrypt_enc_get_iv_size($td);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		/* Initialize encryption handle */
		if (mcrypt_generic_init($td, $key, $iv) != -1) {
			/* Encrypt data */
			$c_t = mcrypt_generic($td, $string);
			mcrypt_generic_deinit($td);
			mcrypt_module_close($td);
			$c_t = $iv.$c_t;
			if($ishex) {
				return bin2hex($c_t);
				//return base64_encode($c_t);
			}
			else {
				return $c_t;
			}
		}
		else {
			return "";
		}
  }
  
  /**
  * fun: DecodeString
  * des: 对字符串Decode处理
  *
  * @param $string string 待加密的字符串
  * @param $salt string 用于加密的字符串，相当于私钥
  * @param $ishex bool 是否是16进制字符串形式
  * @return string Decode后的字符串
  */
  public static function DecodeString($string,$salt,$ishex=true, $mode='cfb') {
		$key = md5($salt); //to improve variance
		/* Open module, and create IV */
		$mode = empty($mode)?'cfb' : $mode;
		$td = mcrypt_module_open('des', '',$mode, '');
		$key = substr($key, 0, mcrypt_enc_get_key_size($td));
		if($ishex) $string = pack( "H*", $string);
		//if($ishex) $string = base64_decode($string);
		$iv_size = mcrypt_enc_get_iv_size($td);
		$iv = substr($string,0,$iv_size);
		$string = substr($string,$iv_size);
		/* Initialize encryption handle */
		if (mcrypt_generic_init($td, $key, $iv) != -1) {
			/* Encrypt data */
			$c_t = mdecrypt_generic($td, $string);
			mcrypt_generic_deinit($td);
			mcrypt_module_close($td);
			 return $c_t;
		} 
		else {
			return "";
		}
  }
 
  /**
  * fun: Encrypt
  * des: 不可逆可用此方式
  *		生成类似于md5的hash字符串，用于密码加密，校验码等
  *
  * @param $data string 用于加密的字符串
  * @param $key string 是否将时间作为输入参数融入到Key中
  * @param $hash_method string 目前只支持md5和sha1，默认为md5
  * @return string 长度为40的字符串
  */
  public static function Encrypt($data, $key, $hash_method="md5") {
  	$ret = $data;
	//$logfile = "/tmp/api.log";
	//error_log("--$data--\n",3,$logfile);
  	if($hash_method == "sha1") {
  		$ret = sha1($data);
  	}
  	else {
  		$ret = md5($data).sprintf('%08x',crc32($data));
  	}
	//error_log("--crc32:".crc32($data)."--\n",3,$logfile);
	//error_log("--step1:$ret--\n",3,$logfile);
  	$ret = sha1($ret.$key);
	//error_log("--step2:$ret--\n",3,$logfile);
  	if($hash_method == "sha1") {
  		$ret = sha1($ret);
  	}
  	else {
  		$ret = md5($ret).sprintf('%08x',crc32($data));
  	}
	//error_log("--crc32:".crc32($data)."--\n",3,$logfile);
	//error_log("--step3:$ret--\n",3,$logfile);
  	return $ret;
  }
}
?>

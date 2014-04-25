<?php
class MyTopClient extends TopClient{
	
	public $tokenUrl;
	
	function __construct(){
		$tconfig = Doo::conf()->TOP;
		foreach($tconfig as $k => $v){
			$this->$k = $v;
		}
	}
	
	function getLoginUrl($callback,$state = 1){
		$param = http_build_query(array(
				'response_type' => 'code',
				'client_id' => $this->appkey,
				'redirect_uri' => urlencode(trim($callback)),
				'state' => trim($state)
		));
		return $this->gatewayUrl."?".$param;
	}
	
	function getToken($code,$callback=""){
		$grant_type = 'authorization_code';
		if(!$callback){
			$callback = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		}
		
		//请求参数
		$postfields= array(
				'grant_type'     => $grant_type,
				'client_id'     => $this->appkey,
				'client_secret' => $this->secretKey,
				'code'          => $code,
				'redirect_uri'  => urlencode(trim($callback))
		);
		
		return json_decode($this->curl($this->tokenUrl,$postfields),true);
		
	}
	
}
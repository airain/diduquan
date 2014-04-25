<?php
class session_db {
	//static protected $session_data = '';
	static protected $session_name = 'xosid';
	static protected $session_path = 'db';
	static protected $session_expire = 3600; //作废
	static protected $smo = false;
	static $uid = 0;

	static function open($save_path, $session_name){
		self::$session_name = $session_name;
		self::$session_path = $save_path;
		self::$smo = new Model('sys_session');
		return(true);
	}

	static function close(){
		return(true);
	}

	static function read($id){
		if(!$id){
			$id = md5(microtime().rand(1,9999999999999999999999999));
			session_id($id);
			setcookie(self::$session_name,$id,0,'/');
		};
		$reault = self::$smo->select(array('sid'=>$id),false,'sessdata,uid',-1,-1,false/*,'uptime>='.(time()-self::$session_expire)*/);
		if(count($reault)==1){
			self::$uid = $reault[0]['uid'];
			return unserialize($reault[0]['sessdata']);
		}
		return '';
	}

	static function write($id, $sess_data){
		if(!isset($_SESSION['UID']) || !$id ){
			return ;
		}
		$sess_data = serialize($sess_data);
		if(self::$uid){//update
			return self::$smo->update(array('sessdata'=>$sess_data,'uid'=>$_SESSION['UID'],'uptime'=>time()),array('sid'=>$id));
		}else{// insert
			self::gc(0);
			return self::$smo->insert(array('sid'=>$id,'uid'=>$_SESSION['UID'],'uptime'=>time(),'sessdata'=>$sess_data));
		}
	}

	static function destroy($id){
		setcookie(self::$session_name,$id,1,'/');
		return self::$smo->delete(array('sid'=>$id));
	}

	static function gc($maxlifetime){
		return self::$smo->delete(false,'uptime<'.(time()-ini_get("session.gc_maxlifetime")));
	}
	
	static function cnt(){
		$result = self::$smo->getOne(false,'count(*) as cnt');
		return $result['cnt'];
	}
}
session_set_save_handler("session_db::open", "session_db::close", "session_db::read", "session_db::write", "session_db::destroy", "session_db::gc");
session_name('CRMID');
<?php
Doo::loadCore('db/DooModel');

class BaseModel extends DooModel{
	private $_properties = null;

	public function __construct($properties=null){
		parent::__construct($properties);
		$this->_properties = $properties;
	}

	public function setProperties($properties){
       if($properties!==null){
            foreach($properties as $k=>$v){
                if(in_array($k, $this->_fields))
                    $this->{$k} = $v;
            }
        }
    }

    public function fetchAll($query, $params=null){
    	return $this->db()->fetchAll($query, $params);
    }

	public function find($opt=null){
		//if(!!$opt && !isset($opt['asArray']))$opt['asArray'] = true;
		return parent::find($opt);
	}

	public function getOne($opt=null){
		//if(!!$opt && !isset($opt['asArray']))$opt['asArray'] = true;
		return parent::getOne($opt);
	}

    public function insert(){
    	if(property_exists($this,"mktime") && !$this->mktime){
    		$this->mktime = time();
    	}
    	if(property_exists($this,"createtime") && !$this->createtime){
    		$this->createtime = time();
    	}
    	if(property_exists($this,"uptime") && !$this->uptime){
    		$this->uptime = time();
    	}
    	if(property_exists($this, "maker") && !$this->maker && isset($_SESSION['UID'])){
    		$this->maker = $_SESSION['UID'];
    	}
		try{
    		return parent::insert();
		}catch(Exception $e){
			return false;
		}
    }
    
    public function update($opt=null){
    	if(property_exists($this,"uptime") && !$this->uptime){
    		$this->uptime = time();
    	}
		try{
    		return parent::update($opt);
		}catch(Exception $e){
			return false;
		}
    }

	public function replace(){
		if(property_exists($this,"mktime") && !$this->mktime){
    		$this->mktime = time();
    	}
    	if(property_exists($this,"uptime") && !$this->uptime){
    		$this->uptime = time();
    	}
    	if(property_exists($this, "maker") && !$this->maker && isset($_SESSION['UID'])){
    		$this->maker = $_SESSION['UID'];
    	}
		try{
			$values = array();
			$valuestr = '';
			$fieldstr = '';

			foreach($this->_properties as $o=>$v){
				if(isset($v) && in_array($o, $this->_fields)){
					$values[] = $v;
					$valuestr .= '?,';
					$fieldstr .= '`'.$o .'`,';
				}
			}

			$valuestr = substr($valuestr, 0, strlen($valuestr)-1);
			$fieldstr = substr($fieldstr, 0, strlen($fieldstr)-1);

			$sql ="REPLACE INTO {$this->_table} ($fieldstr) VALUES ($valuestr)";
			return parent::db()->query($sql, $values)->rowCount();
		}catch(Exception $e){
			return false;
		}
	}
	
	/**
	* Doo::loadService('RuleService');
	  $ruleServ = new RuleService();
	  $rule = array(
			'score'=>array('asc'=>'1')
		);
		$ruleServ->getRuleObj($rule)->updateCnt($opt);
	*/
	public function updateCnt($opt=null){
		try{
			$field_and_value = '';
			foreach($this->_properties as $o=>$v){
				if(isset($v) && in_array($o, $this->_fields) && is_array($v)){
					if(!isset($v['asc']) && !isset($v['desc'])) continue;
					$num = 0;
					if(isset($v['asc'])) $num += $v['asc'];
					elseif(isset($v['desc']))$num -= $v['desc'];
					$field_and_value .= '`'.$o .'`=if(`'.$o .'`+('.$num.')>0,`'.$o .'`+('.$num.'),0),';
				}
			}
			$field_and_value = substr($field_and_value, 0, strlen($field_and_value)-1);
			if(empty($field_and_value)) return false;

			$where = (!isset($opt['where']) || empty($opt['where']))?'':'WHERE '.$opt['where'];
			$values = (!isset($opt['param']) || empty($opt['param']))? null : $opt['param'];

			$sql ="UPDATE {$this->_table} SET {$field_and_value} {$where}";
			return parent::db()->query($sql, $values)->rowCount();
		}catch(Exception $e){
			return false;
		}
    }

}
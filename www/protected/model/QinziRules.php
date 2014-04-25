<?php
Doo::loadClassAt('Base/BaseModel');

class QinziRules extends BaseModel{

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $id;

    /**
     * @var varchar Max length is 30.
     */
    public $name;

    /**
     * @var varchar Max length is 30.
     */
    public $ename;

    /**
     * @var enum '+','-').
     */
    public $type;

    /**
     * @var smallint Max length is 10.  unsigned.
     */
    public $score;

    /**
     * @var varchar Max length is 100.
     */
    public $desc;

    /**
     * @var smallint Max length is 10.  unsigned.
     */
    public $limit_count;

    /**
     * @var smallint Max length is 10.  unsigned.
     */
    public $limit_time;

    public $_table = 'qinzi_rules';
    public $_primarykey = 'id';
    public $_fields = array('id','name','ename','type','score','desc','limit_count','limit_time');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'name' => array(
                        array( 'maxlength', 30 ),
                        array( 'optional' ),
                ),

                'ename' => array(
                        array( 'maxlength', 30 ),
                        array( 'optional' ),
                ),

                'type' => array(
                        array( 'optional' ),
                ),

                'score' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 10 ),
                        array( 'notnull' ),
                ),

                'desc' => array(
                        array( 'maxlength', 100 ),
                        array( 'optional' ),
                ),

                'limit_count' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 10 ),
                        array( 'notnull' ),
                ),

                'limit_time' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 10 ),
                        array( 'notnull' ),
                )
            );
    }

}
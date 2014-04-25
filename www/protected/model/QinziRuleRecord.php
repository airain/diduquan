<?php
Doo::loadClassAt('Base/BaseModel');

class QinziRuleRecord extends BaseModel{

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $uid;

    /**
     * @var varchar Max length is 50.
     */
    public $name;

    /**
     * @var varchar Max length is 30.
     */
    public $ename;

    /**
     * @var int Max length is 10.  unsigned.
     */
    public $pre_score;

    /**
     * @var smallint Max length is 10.
     */
    public $score;

    /**
     * @var varchar Max length is 100.
     */
    public $info;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $createtime;

    public $_table = 'qinzi_rule_record';
    public $_primarykey = 'id';
    public $_fields = array('id','uid','name','ename','pre_score','score','info','createtime');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'uid' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'name' => array(
                        array( 'maxlength', 50 ),
                        array( 'optional' ),
                ),

                'ename' => array(
                        array( 'maxlength', 30 ),
                        array( 'optional' ),
                ),

                'pre_score' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 10 ),
                        array( 'notnull' ),
                ),

                'score' => array(
                        array( 'integer' ),
                        array( 'maxlength', 10 ),
                        array( 'notnull' ),
                ),

                'info' => array(
                        array( 'maxlength', 100 ),
                        array( 'optional' ),
                ),

                'createtime' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                )
            );
    }

}
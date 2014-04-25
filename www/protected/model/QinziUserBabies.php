<?php
Doo::loadClassAt('Base/BaseModel');

class QinziUserBabies extends BaseModel{

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $id;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $uid;

    /**
     * @var tinyint Max length is 1.
     */
    public $baby_state;

    /**
     * @var varchar Max length is 50.
     */
    public $baby_name;

    /**
     * @var date
     */
    public $baby_birth;

    /**
     * @var enum '男','女').
     */
    public $baby_sex;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $createtime;

    public $_table = 'qinzi_user_babies';
    public $_primarykey = 'id';
    public $_fields = array('id','uid','baby_state','baby_name','baby_birth','baby_sex','createtime');

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
                        array( 'min', 0 ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'baby_state' => array(
                        array( 'integer' ),
                        array( 'maxlength', 1 ),
                        array( 'optional' ),
                ),

                'baby_name' => array(
                        array( 'maxlength', 50 ),
                        array( 'optional' ),
                ),

                'baby_birth' => array(
                        array( 'date' ),
                        array( 'optional' ),
                ),

                'baby_sex' => array(
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
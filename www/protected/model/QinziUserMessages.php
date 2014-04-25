<?php
Doo::loadClassAt('Base/BaseModel');

class QinziUserMessages extends BaseModel{

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $id;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $uid;

    /**
     * @var tinyint Max length is 1.  unsigned.
     */
    public $type;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $touid;

    /**
     * @var varchar Max length is 300.
     */
    public $content;

    /**
     * @var tinyint Max length is 1.
     */
    public $state;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $createtime;

    public $_table = 'qinzi_user_messages';
    public $_primarykey = 'id';
    public $_fields = array('id','uid','type','touid','content','state','createtime');

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

                'type' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                ),

                'touid' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'content' => array(
                        array( 'maxlength', 300 ),
                        array( 'optional' ),
                ),

                'state' => array(
                        array( 'integer' ),
                        array( 'maxlength', 1 ),
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
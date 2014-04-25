<?php
Doo::loadClassAt('Base/BaseModel');

class QinziUserFriends extends BaseModel{

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $id;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $uid;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $fuid;

    /**
     * @var tinyint Max length is 1.
     */
    public $state;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $mktime;

    public $_table = 'qinzi_user_friends';
    public $_primarykey = 'id';
    public $_fields = array('id','uid','fuid','state','mktime');

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

                'fuid' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'state' => array(
                        array( 'integer' ),
                        array( 'maxlength', 1 ),
                        array( 'optional' ),
                ),

                'mktime' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                )
            );
    }

}
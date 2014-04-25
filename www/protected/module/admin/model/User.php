<?php
Doo::loadClassAt('Base/BaseModel');

class User extends BaseModel{

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $id;

    /**
     * @var tinyint Max length is 1.  unsigned.
     */
    public $type;

    /**
     * @var varchar Max length is 64.
     */
    public $nick;

    /**
     * @var varchar Max length is 128.
     */
    public $email;

    /**
     * @var varchar Max length is 16.
     */
    public $mobile;

    /**
     * @var varchar Max length is 32.
     */
    public $password;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $tao_uid;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $last_time;

    /**
     * @var varchar Max length is 15.
     */
    public $last_ip;

    /**
     * @var tinyint Max length is 1.  unsigned.
     */
    public $state;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $maker;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $mktime;

    /**
     * @var tinyint Max length is 1.  unsigned.
     */
    public $disable;

    public $_table = 'user';
    public $_primarykey = 'id';
    public $_fields = array('id','type','nick','email','mobile','password','tao_uid','last_time','last_ip','state','maker','mktime','disable');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'type' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                ),

                'nick' => array(
                        array( 'maxlength', 64 ),
                        array( 'notnull' ),
                ),

                'email' => array(
                        array( 'maxlength', 128 ),
                        array( 'notnull' ),
                ),

                'mobile' => array(
                        array( 'maxlength', 16 ),
                        array( 'notnull' ),
                ),

                'password' => array(
                        array( 'maxlength', 32 ),
                        array( 'notnull' ),
                ),

                'tao_uid' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'last_time' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'last_ip' => array(
                        array( 'maxlength', 15 ),
                        array( 'notnull' ),
                ),

                'state' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                ),

                'maker' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'mktime' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'disable' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                )
            );
    }

}
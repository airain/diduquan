<?php
Doo::loadClassAt('Base/BaseModel');

class QinziUsers extends BaseModel{

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $uid;

    /**
     * @var varchar Max length is 50.
     */
    public $nick;

    /**
     * @var varchar Max length is 64.
     */
    public $pwd;

    /**
     * @var enum '男','女').
     */
    public $gender;

    /**
     * @var varchar Max length is 100.
     */
    public $avatar;

    /**
     * @var varchar Max length is 100.
     */
    public $email;

    /**
     * @var varchar Max length is 20.
     */
    public $realname;

    /**
     * @var varchar Max length is 15.
     */
    public $mobile;

    /**
     * @var varchar Max length is 100.
     */
    public $address;

    /**
     * @var varchar Max length is 6.
     */
    public $postcode;

    /**
     * @var tinyint Max length is 1.
     */
    public $isemail;

    /**
     * @var tinyint Max length is 1.
     */
    public $status;

    /**
     * @var int Max length is 11.
     */
    public $jifen;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $regtime;

    /**
     * @var int Max length is 11.
     */
    public $try_cnt;

    /**
     * @var int Max length is 11.
     */
    public $try_bj_cnt;

    /**
     * @var varchar Max length is 15.
     */
    public $last_ip;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $last_time;

    public $_table = 'qinzi_users';
    public $_primarykey = 'uid';
    public $_fields = array('uid','nick','pwd','gender','avatar','email','realname','mobile','address','postcode','isemail','status','jifen','regtime','try_cnt','try_bj_cnt','last_ip','last_time');

    public function getVRules() {
        return array(
                'uid' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'nick' => array(
                        array( 'maxlength', 50 ),
                        array( 'notnull' ),
                ),

                'pwd' => array(
                        array( 'maxlength', 64 ),
                        array( 'notnull' ),
                ),

                'gender' => array(
                        array( 'optional' ),
                ),

                'avatar' => array(
                        array( 'maxlength', 100 ),
                        array( 'optional' ),
                ),

                'email' => array(
                        array( 'maxlength', 100 ),
                        array( 'optional' ),
                ),

                'realname' => array(
                        array( 'maxlength', 20 ),
                        array( 'optional' ),
                ),

                'mobile' => array(
                        array( 'maxlength', 15 ),
                        array( 'optional' ),
                ),

                'address' => array(
                        array( 'maxlength', 100 ),
                        array( 'optional' ),
                ),

                'postcode' => array(
                        array( 'maxlength', 6 ),
                        array( 'optional' ),
                ),

                'isemail' => array(
                        array( 'integer' ),
                        array( 'maxlength', 1 ),
                        array( 'optional' ),
                ),

                'status' => array(
                        array( 'integer' ),
                        array( 'maxlength', 1 ),
                        array( 'optional' ),
                ),

                'jifen' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'regtime' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'try_cnt' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'try_bj_cnt' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'last_ip' => array(
                        array( 'maxlength', 15 ),
                        array( 'notnull' ),
                ),

                'last_time' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                )
            );
    }

}
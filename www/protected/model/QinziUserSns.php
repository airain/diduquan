<?php
Doo::loadClassAt('Base/BaseModel');

class QinziUserSns extends BaseModel{

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $id;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $uid;

    /**
     * @var varchar Max length is 10.
     */
    public $sns_site;

    /**
     * @var varchar Max length is 64.
     */
    public $sns_uid;

    /**
     * @var varchar Max length is 20.
     */
    public $sns_name;

    /**
     * @var varchar Max length is 100.
     */
    public $sns_token;

    /**
     * @var varchar Max length is 100.
     */
    public $sns_secret;

    /**
     * @var smallint Max length is 10.
     */
    public $sns_expires;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $uptime;

    public $_table = 'qinzi_user_sns';
    public $_primarykey = 'id';
    public $_fields = array('id','uid','sns_site','sns_uid','sns_name','sns_token','sns_secret','sns_expires','uptime');

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

                'sns_site' => array(
                        array( 'maxlength', 10 ),
                        array( 'notnull' ),
                ),

                'sns_uid' => array(
                        array( 'maxlength', 64 ),
                        array( 'notnull' ),
                ),

                'sns_name' => array(
                        array( 'maxlength', 20 ),
                        array( 'notnull' ),
                ),

                'sns_token' => array(
                        array( 'maxlength', 100 ),
                        array( 'optional' ),
                ),

                'sns_secret' => array(
                        array( 'maxlength', 100 ),
                        array( 'optional' ),
                ),

                'sns_expires' => array(
                        array( 'integer' ),
                        array( 'maxlength', 10 ),
                        array( 'optional' ),
                ),

                'uptime' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                )
            );
    }

}
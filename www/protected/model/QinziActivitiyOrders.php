<?php
Doo::loadClassAt('Base/BaseModel');

class QinziActivitiyOrders extends BaseModel{

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $aoid;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $aid;

    /**
     * @var varchar Max length is 100.
     */
    public $title;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $uid;

    /**
     * @var smallint Max length is 5.  unsigned.
     */
    public $cnt;

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
    public $state;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $createtime;

    public $_table = 'qinzi_activitiy_orders';
    public $_primarykey = 'aoid';
    public $_fields = array('aoid','aid','title','uid','cnt','realname','mobile','address','postcode','state','createtime');

    public function getVRules() {
        return array(
                'aoid' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'aid' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'title' => array(
                        array( 'maxlength', 100 ),
                        array( 'optional' ),
                ),

                'uid' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'cnt' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 5 ),
                        array( 'notnull' ),
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
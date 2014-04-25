<?php
Doo::loadClassAt('Base/BaseModel');

class QinziActivities extends BaseModel{

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $aid;

    /**
     * @var varchar Max length is 120.
     */
    public $title;

    /**
     * @var text
     */
    public $content;

    /**
     * @var varchar Max length is 120.
     */
    public $sponsor;

    /**
     * @var varchar Max length is 100.
     */
    public $pic;

    /**
     * @var int Max length is 1.  unsigned.
     */
    public $totype;

    /**
     * @var varchar Max length is 50.
     */
    public $city;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $city_id;

    /**
     * @var varchar Max length is 50.
     */
    public $provice;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $province_id;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $type;

    /**
     * @var tinyint Max length is 1.  unsigned.
     */
    public $isfree;

    /**
     * @var smallint Max length is 8.  unsigned.
     */
    public $used_cnt;

    /**
     * @var smallint Max length is 8.  unsigned.
     */
    public $remain_cnt;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $b_cnt;

    /**
     * @var date
     */
    public $b_stattime;

    /**
     * @var date
     */
    public $b_endtime;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $createtime;

    public $_table = 'qinzi_activities';
    public $_primarykey = 'aid';
    public $_fields = array('aid','title','content','sponsor','pic','totype','city','city_id','provice','province_id','type','isfree','used_cnt','remain_cnt','b_cnt','b_stattime','b_endtime','createtime');

    public function getVRules() {
        return array(
                'aid' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'title' => array(
                        array( 'maxlength', 120 ),
                        array( 'notnull' ),
                ),

                'content' => array(
                        array( 'optional' ),
                ),

                'sponsor' => array(
                        array( 'maxlength', 120 ),
                        array( 'notnull' ),
                ),

                'pic' => array(
                        array( 'maxlength', 100 ),
                        array( 'optional' ),
                ),

                'totype' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                ),

                'city' => array(
                        array( 'maxlength', 50 ),
                        array( 'optional' ),
                ),

                'city_id' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'provice' => array(
                        array( 'maxlength', 50 ),
                        array( 'optional' ),
                ),

                'province_id' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'type' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'isfree' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                ),

                'used_cnt' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 8 ),
                        array( 'notnull' ),
                ),

                'remain_cnt' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 8 ),
                        array( 'notnull' ),
                ),

                'b_cnt' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'b_stattime' => array(
                        array( 'date' ),
                        array( 'optional' ),
                ),

                'b_endtime' => array(
                        array( 'date' ),
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
<?php
Doo::loadClassAt('Base/BaseModel');

class QinziProducts extends BaseModel{

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $pid;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $parter_id;

    /**
     * @var varchar Max length is 120.
     */
    public $title;

    /**
     * @var int Max length is 11.
     */
    public $type_id;

    /**
     * @var float Max length is 5. ,2).
     */
    public $price;

    /**
     * @var smallint Max length is 10.
     */
    public $jifen;

    /**
     * @var smallint Max length is 10.
     */
    public $reward_jifen;

    /**
     * @var tinyint Max length is 1.  unsigned.
     */
    public $totype;

    /**
     * @var varchar Max length is 200.
     */
    public $desc;

    /**
     * @var text
     */
    public $content;

    /**
     * @var varchar Max length is 100.
     */
    public $pic;

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
     * @var tinyint Max length is 1.  unsigned.
     */
    public $posttype;

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
     * @var date
     */
    public $bg_stattime;

    /**
     * @var date
     */
    public $bg_endtime;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $bg_cnt;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $createtime;

    public $_table = 'qinzi_products';
    public $_primarykey = 'pid';
    public $_fields = array('pid','parter_id','title','type_id','price','jifen','reward_jifen','totype','desc','content','pic','city','city_id','provice','province_id','posttype','used_cnt','remain_cnt','b_cnt','b_stattime','b_endtime','bg_stattime','bg_endtime','bg_cnt','createtime');

    public function getVRules() {
        return array(
                'pid' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'parter_id' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'title' => array(
                        array( 'maxlength', 120 ),
                        array( 'notnull' ),
                ),

                'type_id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'price' => array(
                        array( 'float' ),
                        array( 'notnull' ),
                ),

                'jifen' => array(
                        array( 'integer' ),
                        array( 'maxlength', 10 ),
                        array( 'notnull' ),
                ),

                'reward_jifen' => array(
                        array( 'integer' ),
                        array( 'maxlength', 10 ),
                        array( 'notnull' ),
                ),

                'totype' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                ),

                'desc' => array(
                        array( 'maxlength', 200 ),
                        array( 'optional' ),
                ),

                'content' => array(
                        array( 'optional' ),
                ),

                'pic' => array(
                        array( 'maxlength', 100 ),
                        array( 'optional' ),
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

                'posttype' => array(
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

                'bg_stattime' => array(
                        array( 'date' ),
                        array( 'optional' ),
                ),

                'bg_endtime' => array(
                        array( 'date' ),
                        array( 'optional' ),
                ),

                'bg_cnt' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
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
<?php
Doo::loadClassAt('Base/BaseModel');

class QinziProductTopics extends BaseModel{

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $prid;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $uid;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $pid;

    /**
     * @var varchar Max length is 100.
     */
    public $title;

    /**
     * @var varchar Max length is 200.
     */
    public $des;

    /**
     * @var smallint Max length is 5.
     */
    public $img_cnt;

    /**
     * @var text
     */
    public $content;

    /**
     * @var smallint Max length is 10.
     */
    public $reward_jifen;

    /**
     * @var smallint Max length is 10.
     */
    public $reward_ojifen;

    /**
     * @var tinyint Max length is 1.
     */
    public $state;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $createtime;

    public $_table = 'qinzi_product_topics';
    public $_primarykey = 'prid';
    public $_fields = array('prid','uid','pid','title','des','img_cnt','content','reward_jifen','reward_ojifen','state','createtime');

    public function getVRules() {
        return array(
                'prid' => array(
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

                'pid' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'title' => array(
                        array( 'maxlength', 100 ),
                        array( 'optional' ),
                ),

                'des' => array(
                        array( 'maxlength', 200 ),
                        array( 'optional' ),
                ),

                'img_cnt' => array(
                        array( 'integer' ),
                        array( 'maxlength', 5 ),
                        array( 'optional' ),
                ),

                'content' => array(
                        array( 'optional' ),
                ),

                'reward_jifen' => array(
                        array( 'integer' ),
                        array( 'maxlength', 10 ),
                        array( 'optional' ),
                ),

                'reward_ojifen' => array(
                        array( 'integer' ),
                        array( 'maxlength', 10 ),
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
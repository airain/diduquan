<?php
Doo::loadClassAt('Base/BaseModel');

class QinziProductApplies extends BaseModel{

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $paid;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $uid;

    /**
     * @var varchar Max length is 100.
     */
    public $title;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $pid;

    /**
     * @var tinyint Max length is 1.
     */
    public $isbg;

    /**
     * @var varchar Max length is 300.
     */
    public $des;

    /**
     * @var tinyint Max length is 1.
     */
    public $state;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $createtime;

    public $_table = 'qinzi_product_applies';
    public $_primarykey = 'paid';
    public $_fields = array('paid','uid','title','pid','isbg','des','state','createtime');

    public function getVRules() {
        return array(
                'paid' => array(
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

                'title' => array(
                        array( 'maxlength', 100 ),
                        array( 'optional' ),
                ),

                'pid' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'isbg' => array(
                        array( 'integer' ),
                        array( 'maxlength', 1 ),
                        array( 'optional' ),
                ),

                'des' => array(
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
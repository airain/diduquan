<?php
Doo::loadClassAt('Base/BaseModel');

class QinziActivitiyComments extends BaseModel{

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $acid;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $aid;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $uid;

    /**
     * @var tinyint Max length is 1.  unsigned.
     */
    public $type;

    /**
     * @var varchar Max length is 200.
     */
    public $content;

    /**
     * @var varchar Max length is 100.
     */
    public $pic;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $parentid;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $createtime;

    public $_table = 'qinzi_activitiy_comments';
    public $_primarykey = 'acid';
    public $_fields = array('acid','aid','uid','type','content','pic','parentid','createtime');

    public function getVRules() {
        return array(
                'acid' => array(
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

                'content' => array(
                        array( 'maxlength', 200 ),
                        array( 'optional' ),
                ),

                'pic' => array(
                        array( 'maxlength', 100 ),
                        array( 'optional' ),
                ),

                'parentid' => array(
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
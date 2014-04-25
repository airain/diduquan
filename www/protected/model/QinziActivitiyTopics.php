<?php
Doo::loadClassAt('Base/BaseModel');

class QinziActivitiyTopics extends BaseModel{

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $tpid;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $aid;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $uid;

    /**
     * @var varchar Max length is 100.
     */
    public $title;

    /**
     * @var text
     */
    public $content;

    /**
     * @var varchar Max length is 100.
     */
    public $pic;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $createtime;

    public $_table = 'qinzi_activitiy_topics';
    public $_primarykey = 'tpid';
    public $_fields = array('tpid','aid','uid','title','content','pic','createtime');

    public function getVRules() {
        return array(
                'tpid' => array(
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

                'title' => array(
                        array( 'maxlength', 100 ),
                        array( 'optional' ),
                ),

                'content' => array(
                        array( 'optional' ),
                ),

                'pic' => array(
                        array( 'maxlength', 100 ),
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
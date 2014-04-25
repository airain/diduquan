<?php
Doo::loadClassAt('Base/BaseModel');

class QinziShare extends BaseModel{

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $id;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $uid;

    /**
     * @var tinyint Max length is 1.  unsigned.
     */
    public $type;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $oid;

    /**
     * @var varchar Max length is 10.
     */
    public $sns_site;

    /**
     * @var smallint Max length is 5.
     */
    public $jifen;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $createtime;

    public $_table = 'qinzi_share';
    public $_primarykey = 'id';
    public $_fields = array('id','uid','type','oid','sns_site','jifen','createtime');

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

                'type' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                ),

                'oid' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'sns_site' => array(
                        array( 'maxlength', 10 ),
                        array( 'optional' ),
                ),

                'jifen' => array(
                        array( 'integer' ),
                        array( 'maxlength', 5 ),
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
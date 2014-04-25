<?php
Doo::loadClassAt('Base/BaseModel');

class EmailLog extends BaseModel{

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $id;

    /**
     * @var varchar Max length is 128.
     */
    public $email;

    /**
     * @var varchar Max length is 16.
     */
    public $type;

    /**
     * @var tinyint Max length is 1.  unsigned.
     */
    public $state;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $maker;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $mktime;

    public $_table = 'email_log';
    public $_primarykey = 'id';
    public $_fields = array('id','email','type','state','maker','mktime');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'email' => array(
                        array( 'maxlength', 128 ),
                        array( 'notnull' ),
                ),

                'type' => array(
                        array( 'maxlength', 16 ),
                        array( 'notnull' ),
                ),

                'state' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                ),

                'maker' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'mktime' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                )
            );
    }

}
<?php
Doo::loadClassAt('Base/BaseModel');

class EmailUnsubscribe extends BaseModel{

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $id;

    /**
     * @var varchar Max length is 128.
     */
    public $email;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $maker;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $mktime;

    public $_table = 'email_unsubscribe';
    public $_primarykey = 'id';
    public $_fields = array('id','email','maker','mktime');

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
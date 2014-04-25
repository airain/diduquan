<?php
Doo::loadClassAt('Base/BaseModel');

class Email extends BaseModel{

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $id;

    /**
     * @var tinyint Max length is 1.  unsigned.
     */
    public $type;

    /**
     * @var varchar Max length is 128.
     */
    public $email;

    /**
     * @var varchar Max length is 64.
     */
    public $nick;

    /**
     * @var varchar Max length is 32.
     */
    public $md5;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $maker;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $mktime;

    /**
     * @var tinyint Max length is 1.  unsigned.
     */
    public $disable;

    public $_table = 'email';
    public $_primarykey = 'id';
    public $_fields = array('id','type','email','nick','md5','maker','mktime','disable');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'type' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                ),

                'email' => array(
                        array( 'maxlength', 128 ),
                        array( 'notnull' ),
                ),

                'nick' => array(
                        array( 'maxlength', 64 ),
                        array( 'notnull' ),
                ),

                'md5' => array(
                        array( 'maxlength', 32 ),
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
                ),

                'disable' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                )
            );
    }

}
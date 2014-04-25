<?php
Doo::loadClassAt('Base/BaseModel');

class Log extends BaseModel{

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $id;

    /**
     * @var varchar Max length is 16.
     */
    public $type;

    /**
     * @var varchar Max length is 255.
     */
    public $uri;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $did;

    /**
     * @var varchar Max length is 512.
     */
    public $message;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $maker;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $mktime;

    public $_table = 'log';
    public $_primarykey = 'id';
    public $_fields = array('id','type','uri','did','message','maker','mktime');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'type' => array(
                        array( 'maxlength', 16 ),
                        array( 'notnull' ),
                ),

                'uri' => array(
                        array( 'maxlength', 255 ),
                        array( 'notnull' ),
                ),

                'did' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'message' => array(
                        array( 'maxlength', 512 ),
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
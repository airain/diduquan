<?php
Doo::loadClassAt('Base/BaseModel');

class Menu extends BaseModel{

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $id;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $pid;

    /**
     * @var varchar Max length is 64.
     */
    public $name;

    /**
     * @var smallint Max length is 6.  unsigned.
     */
    public $sort;

    /**
     * @var varchar Max length is 255.
     */
    public $url;

    /**
     * @var varchar Max length is 32.
     */
    public $target;

    /**
     * @var tinyint Max length is 1.  unsigned.
     */
    public $isleaf;

    /**
     * @var tinyint Max length is 1.  unsigned.
     */
    public $deep;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $maker;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $mktime;

    public $_table = 'menu';
    public $_primarykey = 'id';
    public $_fields = array('id','pid','name','sort','url','target','isleaf','deep','maker','mktime');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'pid' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'name' => array(
                        array( 'maxlength', 64 ),
                        array( 'notnull' ),
                ),

                'sort' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 6 ),
                        array( 'notnull' ),
                ),

                'url' => array(
                        array( 'maxlength', 255 ),
                        array( 'notnull' ),
                ),

                'target' => array(
                        array( 'maxlength', 32 ),
                        array( 'notnull' ),
                ),

                'isleaf' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                ),

                'deep' => array(
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
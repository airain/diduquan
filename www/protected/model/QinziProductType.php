<?php
Doo::loadClassAt('Base/BaseModel');

class QinziProductType extends BaseModel{

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $id;

    /**
     * @var varchar Max length is 120.
     */
    public $name;

    /**
     * @var tinyint Max length is 1.
     */
    public $type;

    public $_table = 'qinzi_product_type';
    public $_primarykey = 'id';
    public $_fields = array('id','name','type');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'name' => array(
                        array( 'maxlength', 120 ),
                        array( 'notnull' ),
                ),

                'type' => array(
                        array( 'integer' ),
                        array( 'maxlength', 1 ),
                        array( 'optional' ),
                )
            );
    }

}
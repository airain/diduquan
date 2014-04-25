<?php
Doo::loadClassAt('Base/BaseModel');

class QinziParters extends BaseModel{

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $id;

    /**
     * @var varchar Max length is 50.
     */
    public $username;

    /**
     * @var varchar Max length is 20.
     */
    public $pwd;

    /**
     * @var varchar Max length is 100.
     */
    public $company;

    /**
     * @var varchar Max length is 200.
     */
    public $logo;

    /**
     * @var tinyint Max length is 1.
     */
    public $type;

    /**
     * @var text
     */
    public $info;

    /**
     * @var varchar Max length is 100.
     */
    public $address;

    /**
     * @var char Max length is 6.
     */
    public $postcode;

    /**
     * @var varchar Max length is 100.
     */
    public $email;

    /**
     * @var varchar Max length is 20.
     */
    public $contact;

    /**
     * @var varchar Max length is 20.
     */
    public $mobile;

    /**
     * @var varchar Max length is 100.
     */
    public $iphone;

    /**
     * @var tinyint Max length is 1.
     */
    public $statue;

    /**
     * @var tinyint Max length is 1.
     */
    public $disable;

    /**
     * @var int Max length is 11.
     */
    public $mktime;

    public $_table = 'qinzi_parters';
    public $_primarykey = 'id';
    public $_fields = array('id','username','pwd','company','logo','type','info','address','postcode','email','contact','mobile','iphone','statue','disable','mktime');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'username' => array(
                        array( 'maxlength', 50 ),
                        array( 'notnull' ),
                ),

                'pwd' => array(
                        array( 'maxlength', 20 ),
                        array( 'notnull' ),
                ),

                'company' => array(
                        array( 'maxlength', 100 ),
                        array( 'notnull' ),
                ),

                'logo' => array(
                        array( 'maxlength', 200 ),
                        array( 'optional' ),
                ),

                'type' => array(
                        array( 'integer' ),
                        array( 'maxlength', 1 ),
                        array( 'optional' ),
                ),

                'info' => array(
                        array( 'optional' ),
                ),

                'address' => array(
                        array( 'maxlength', 100 ),
                        array( 'optional' ),
                ),

                'postcode' => array(
                        array( 'maxlength', 6 ),
                        array( 'optional' ),
                ),

                'email' => array(
                        array( 'maxlength', 100 ),
                        array( 'optional' ),
                ),

                'contact' => array(
                        array( 'maxlength', 20 ),
                        array( 'optional' ),
                ),

                'mobile' => array(
                        array( 'maxlength', 20 ),
                        array( 'optional' ),
                ),

                'iphone' => array(
                        array( 'maxlength', 100 ),
                        array( 'optional' ),
                ),

                'statue' => array(
                        array( 'integer' ),
                        array( 'maxlength', 1 ),
                        array( 'optional' ),
                ),

                'disable' => array(
                        array( 'integer' ),
                        array( 'maxlength', 1 ),
                        array( 'optional' ),
                ),

                'mktime' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                )
            );
    }

}
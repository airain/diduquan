<?php
$dbmap = array();
/**
 * Example Database connection settings and DB relationship mapping
 * $dbmap[Table A]['has_one'][Table B] = array('foreign_key'=> Table B's column that links to Table A );
 * $dbmap[Table B]['belongs_to'][Table A] = array('foreign_key'=> Table A's column where Table B links to );


//Food relationship
$dbmap['Food']['belongs_to']['FoodType'] = array('foreign_key'=>'id');
$dbmap['Food']['has_many']['Article'] = array('foreign_key'=>'food_id');
$dbmap['Food']['has_one']['Recipe'] = array('foreign_key'=>'food_id');
$dbmap['Food']['has_many']['Ingredient'] = array('foreign_key'=>'food_id', 'through'=>'food_has_ingredient');

//Food Type
$dbmap['FoodType']['has_many']['Food'] = array('foreign_key'=>'food_type_id');

//Article
$dbmap['Article']['belongs_to']['Food'] = array('foreign_key'=>'id');

//Recipe
$dbmap['Recipe']['belongs_to']['Food'] = array('foreign_key'=>'id');

//Ingredient
$dbmap['Ingredient']['has_many']['Food'] = array('foreign_key'=>'ingredient_id', 'through'=>'food_has_ingredient');

array(
'main_classname'=>array(
 'has_many[has_one|belongs_to]'=>array(
  'foreign_classname'=>array(
   'foreign_key'=>'',
   'through'=>'tablename',
   'alias'=>'tablename_alias'
  )
 )
)
)

*/

//$dbconfig[ Environment or connection name] = array(Host, Database, User, Password, DB Driver, Make Persistent Connection?);
/**
 * Database settings are case sensitive.
 * To set collation and charset of the db connection, use the key 'collate' and 'charset'
 * array('localhost', 'database', 'root', '1234', 'mysql', true, 'collate'=>'utf8_unicode_ci', 'charset'=>'utf8');
 */

/* $dbconfig['dev'] = array('localhost', 'database', 'root', '1234', 'mysql', true);
 * $dbconfig['prod'] = array('localhost', 'database', 'root', '1234', 'mysql', true);
 */
$dbmap['QinziProductTopics']['belongs_to']['QinziUsers'] = array('foreign_key'=>'uid','through'=>'qinzi_user_babies','alias'=>'ub');

$dbmap['QinziUsers']['belongs_to']['QinziProductTopics'] = array('foreign_key'=>'uid');


$dbconfig['dev'] = array('localhost', 'diduquan', 'root', '123456', 'mysql', true);
$dbconfig['prod'] = array('localhost', 'diduquan', 'root', '123456', 'mysql', true);
$dbconfig['dev']['charset'] = "utf8";
$dbconfig['prod']['charset'] = "utf8";


?>
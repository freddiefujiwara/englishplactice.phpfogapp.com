<?php
/* Text Fixture generated on: 
2011-07-09 21:07:03 : 1310248143 */
class TextFixture extends CakeTestFixture {
	var $name = 'Text';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'english' => array('type' => 'text', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'japansese' => array('type' => 'text', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'text_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'unique'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'text_id' => array('column' => 'text_id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
	);
}
?>

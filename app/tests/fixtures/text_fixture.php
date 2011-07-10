<?php
/* Text Fixture generated on: 
2011-07-09 21:07:03 : 1310248143 */
class TextFixture extends CakeTestFixture {
	var $name = 'Text';

	var $fields = array(
		'id'      => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'english' => array('type' => 'text', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'japanese'=> array('type' => 'text', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
	);
	function __construct(){
		$curl = curl_init("http://englishplactice.appspot.com/apis/texts.js");
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
		foreach(json_decode(curl_exec($curl)) as $text){
			$this -> records[] = array(
						'id' => $text->id,
						'japanese' => $text->japanese,
						'english' => $text->english
			);
		}
		parent::__construct();
	}
}
?>

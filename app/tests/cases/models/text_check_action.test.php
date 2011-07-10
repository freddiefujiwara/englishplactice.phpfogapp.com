<?php
App::import('Model', 'TextCheckAction');

class TextCheckActionTestCase extends CakeTestCase {
	var $fixtures = array('app.text');
	function testGetRangeData(){
		$start = $end = 62;
		$questions = 3;
		$i = 1;
		$text = $this -> TextCheckAction -> getRangeData($start,$end,$i,$questions);
		$this -> assertNotNull($text);
		$this -> assertFalse(empty($text));
		$this -> assertTrue(
			$text["data"]["Text"]["id"] >= $start && 
			$text["data"]["Text"]["id"] <= $end
		);
		$this -> assertTrue(
			$text["start"] >= $start && 
			$text["start"] <= $end
		);
		$this -> assertTrue(
			$text["end"] >= $end && 
			$text["end"] <= $end
		);
		$this -> assertTrue(
			$text["step"] >= 1 && 
			$text["step"] <= ($text["end"] - $text["start"] + 1)
		);
		$this -> assertNotNull($text["question"]);
		$this -> assertNotNull($text["question"]["splitted"]);
		$this -> assertFalse(empty($text["question"]["splitted"]));
		foreach($text["question"]["splitted"] as $word){
			$this -> assertTrue(strlen($word) > 0 );
		}
		$this -> assertFalse(empty($text["question"]["indexes"]));
		foreach($text["question"]["indexes"] as $index){
			$this -> assertTrue(is_numeric($index));
		}
		$this -> assertNotNull($text["question"]["indexes"]);
	}
	function testSetValidate(){
		$start = $end = 62;
		$questions = 3;
		$i = 1;
		$text = $this -> TextCheckAction -> getRangeData($start,$end,$i,$questions);
		$this -> TextCheckAction -> setValidate($text["question"]["splitted"],$text["question"]["indexes"]);
		$this -> assertNotNull($this->TextCheckAction->validate);
	}
	function testValidate(){
		$start = $end = 62;
		$questions = 3;
		$i = 1;
		$text = $this -> TextCheckAction -> getRangeData($start,$end,$i,$questions);
		$this -> TextCheckAction -> setValidate($text["question"]["splitted"],$text["question"]["indexes"]);
		$this->TextCheckAction->validates();
		foreach($text["question"]["indexes"] as $index){
			$this -> assertTrue(array_key_exists("question$index",$this->TextCheckAction->validationErrors));
			$this -> assertEqual("required",$this->TextCheckAction->validationErrors["question$index"]);
		}
		$data = array('TextCheckAction'=>array());
		foreach($text["question"]["indexes"] as $index){
			$data["TextCheckAction"]["question$index"] = $text["question"]["splitted"][$index]."a";
		}
		$this->TextCheckAction-> set($data);
		$this->TextCheckAction->validates();
		foreach($text["question"]["indexes"] as $index){
			$this -> assertTrue(array_key_exists("question$index",$this->TextCheckAction->validationErrors));
			$this -> assertEqual("wrong",$this->TextCheckAction->validationErrors["question$index"]);
		}
		$data = array('TextCheckAction'=>array());
		foreach($text["question"]["indexes"] as $index){
			$data["TextCheckAction"]["question$index"] = $text["question"]["splitted"][$index];
		}
		$this->TextCheckAction-> set($data);
		$this->TextCheckAction->validates();
		foreach($text["question"]["indexes"] as $index){
			$this -> assertFalse(array_key_exists("question$index",$this->TextCheckAction->validationErrors));
		}
	}
	function startTest() {
		echo "START..";
	}

	function endTest() {
		echo "END\n";
	}
	function startCase() {
		$this->TextCheckAction =& ClassRegistry::init('TextCheckAction');
	}

	function endCase() {
		unset($this->TextCheckAction);
		ClassRegistry::flush();
	}

}
?>
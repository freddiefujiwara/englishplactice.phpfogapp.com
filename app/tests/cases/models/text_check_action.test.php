<?php
App::import('Model', 'TextCheckAction');

class TextCheckActionTestCase extends CakeTestCase {
	var $fixtures = array('app.text');
	function testGetDuoNo(){
		$start = 114;
		$end   = 126;
		$questions = 4;
		for($step = 1 ; $step <=12 ; $step ++){
			$text = $this -> TextCheckAction -> getRangeData($start,$end,$step,$questions);
			$this -> assertTrue(is_numeric($text["no"]));
			$this -> assertEqual(114+$step-1,$text["no"]);
		}
	}
	function testGetRangeData(){
		$start = $end = 62;
		$questions = 3;
		$step = 1;
		$text = $this -> TextCheckAction -> getRangeData($start,$end,$step,$questions);
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
			$this -> assertFalse(in_array($text["question"]["splitted"][$index],$this -> TextCheckAction -> ngList));
		}
	}
	function testSetValidate(){
		$start = $end = 62;
		$questions = 3;
		$step = 1;
		$text = $this -> TextCheckAction -> getRangeData($start,$end,$step,$questions);
		$this -> TextCheckAction -> setValidate($text["question"]["splitted"],$text["question"]["indexes"]);
		$this -> assertNotNull($this->TextCheckAction->validate);
	}
	function testValidate(){
		$start = $end = 62;
		$questions = 3;
		$step = 1;
		$text = $this -> TextCheckAction -> getRangeData($start,$end,$step,$questions);
		$this -> TextCheckAction -> setValidate($text["question"]["splitted"],$text["question"]["indexes"]);
		$this->TextCheckAction->validates();
		foreach($text["question"]["indexes"] as $index){
			$this -> assertTrue(array_key_exists("question$index",$this->TextCheckAction->validationErrors));
		}
		$data = array('TextCheckAction'=>array());
		foreach($text["question"]["indexes"] as $index){
			$data["TextCheckAction"]["question$index"] = $text["question"]["splitted"][$index]."a";
		}
		$this->TextCheckAction-> set($data);
		$this->TextCheckAction->validates();
		foreach($text["question"]["indexes"] as $index){
			$this -> assertTrue(array_key_exists("question$index",$this->TextCheckAction->validationErrors));
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
	function startTest($method) {
		echo "\tSTART..$method";
	}

	function endTest() {
		echo "\t..END\n";
	}
	function startCase() {
		echo "TextCheckActionTestCase\n";
		$this->TextCheckAction =& ClassRegistry::init('TextCheckAction');
	}

	function endCase() {
		unset($this->TextCheckAction);
		ClassRegistry::flush();
		echo "end\n";
	}

}
?>

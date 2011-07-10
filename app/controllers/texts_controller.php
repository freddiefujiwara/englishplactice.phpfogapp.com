<?php
class TextsController extends AppController {

	var $name       = 'Texts';
	var $uses       = array("Text","TextCheckAction");
	var $components = array("Texts");

	function index() {
		$text = $this->TextCheckAction -> getRangeData(
			intval($this -> params["start"]),
			intval($this -> params["end"]),
			intval($this -> params["step"]),
			intval($this -> params["questions"])
		);
		if(!is_null($this -> data) && array_key_exists("TextCheckAction",$this -> data) &&
				array_key_exists("indexes",$this -> data["TextCheckAction"])){
			$text["question"]["indexes"] = explode(",",$this -> data["TextCheckAction"]["indexes"]);
			unset($this -> data["TextCheckAction"]["indexes"]);
		}
		if(!is_null($this -> data) && array_key_exists("TextCheckAction",$this -> data)){
			$this -> TextCheckAction -> setValidate($text["question"]["splitted"],$text["question"]["indexes"]);
			$this->TextCheckAction->set($this -> data);
			$this->TextCheckAction->validates();
		}
		$this->set('text', $text);
	}


	function crawl() {
		$this->set('count', $this->Text->crawl());
	}

}
?>

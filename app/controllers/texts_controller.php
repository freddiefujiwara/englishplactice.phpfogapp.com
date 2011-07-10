<?php
class TextsController extends AppController {

	var $name = 'Texts';
	var $uses = array("Text","TextCheckAction");

	function index() {
		$text = $this->TextCheckAction -> getRangeData(
			intval($this -> params["start"]),
			intval($this -> params["end"]),
			intval($this -> params["step"]),
			intval($this -> params["questions"])
		)
		if(array_key_exists("indexes",$this -> data)){
			$text["indexes"] = explode(",",$this -> data["indexes"]);
		}
		$this->set('text', $text);
	}


	function crawl() {
		$this->set('count', $this->Text->crawl());
	}

}
?>

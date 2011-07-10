<?php
class TextsController extends AppController {

	var $name       = 'Texts';
	var $uses       = array("Text","TextCheckAction");
	var $components = array("Texts");

	function index() {
		if(!is_null($this -> data) && array_key_exists("TextCheckAction",$this -> data)){
			$this -> TextCheckAction -> setValidate($this -> viewData["text"]["question"]["splitted"],$this -> viewData["text"]["question"]["indexes"]);
			$this->TextCheckAction->set($this -> data);
			$this->TextCheckAction->validates();
		}
	}


	function crawl() {
		$this->set('count', $this->Text->crawl());
	}

}
?>

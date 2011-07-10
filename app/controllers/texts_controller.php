<?php
class TextsController extends AppController {

	var $name       = 'Texts';
	var $uses       = array("Text","TextCheckAction");
	var $components = array("Texts");

	function index() {
		if(!is_null($this -> data) && array_key_exists("TextCheckAction",$this -> data)){
			$this -> TextCheckAction -> setValidate($this -> viewVars["text"]["question"]["splitted"],$this -> viewVars["text"]["question"]["indexes"]);
			$this->TextCheckAction->set($this -> data);
			$this->TextCheckAction->validates();
		}
	}


	function crawl() {
		$this->set('count', $this->Text->crawl());
	}

	function params() {
		$this->redirect(array(
			'action'    => 'index',
			'start'     => array_key_exists("start",$this -> data) ? intval($this -> data["start"]) : 1,
			'end'       => array_key_exists("end",$this -> data) ? intval($this -> data["end"]) : 1,
			'questions' => array_key_exists("questions",$this -> data) ? intval($this -> data["questions"]) : 1,
			'step'      => 1
		));
	}

}
?>

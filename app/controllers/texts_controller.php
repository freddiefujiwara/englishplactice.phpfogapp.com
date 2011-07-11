<?php
class TextsController extends AppController {

	var $name       = 'Texts';
	var $uses       = array("Text","TextCheckAction");
	var $helpers    = array("Html","Form","Javascript");
	var $components = array("Texts");

	function index() {
		if(!is_null($this -> data) && array_key_exists("TextCheckAction",$this -> data)){
			$this -> TextCheckAction -> setValidate($this -> viewVars["text"]["question"]["splitted"],$this -> viewVars["text"]["question"]["indexes"]);
			$this->TextCheckAction->set($this -> data);
			if($this->TextCheckAction->validates()){
				$this -> redirect(array("action" => "index",
					"start"    => $this -> params["start"],
					"end"      => $this -> params["end"],
					"questions"=> $this -> params["questions"],
					"step"     => $this -> params["step"] + 1
				));
			}
		}
	}


	function crawl() {
		$this->set('count', $this->Text->crawl());
	}

	function params() {
		if(is_null($this->data) || !array_key_exists("Text",$this -> data) ){
			$this -> data = array("Text" => array());
		}
		$this->redirect(array(
			'action'    => 'index',
			'start'     => array_key_exists("start",    $this -> data["Text"]) ? intval($this -> data["Text"]["start"])     : 1,
			'end'       => array_key_exists("end",      $this -> data["Text"]) ? intval($this -> data["Text"]["end"])       : 1,
			'questions' => array_key_exists("questions",$this -> data["Text"]) ? intval($this -> data["Text"]["questions"]) : 1,
			'step'      => 1
		));
	}

}
?>

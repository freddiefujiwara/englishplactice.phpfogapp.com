<?php
class TextsController extends AppController {

	var $name = 'Texts';
	var $uses = array("Text","TextCheckAction");

	function index() {
		$this->set('text', $this->TextCheckAction -> getRangeData(
			intval($this -> params["start"]),
			intval($this -> params["end"]),
			intval($this -> params["step"]),
			intval($this -> params["questions"])
		));

	}

	function crawl() {
		$this->set('count', $this->Text->crawl());
	}

}
?>

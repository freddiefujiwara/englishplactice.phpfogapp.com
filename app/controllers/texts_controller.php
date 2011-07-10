<?php
class TextsController extends AppController {

	var $name = 'Texts';
	var $uses = array("TextCheckAction");

	function index() {
		$this->set('text', $this->TextCheckAction -> getRangeData(1,1,1,3));
	}

	function crawl() {
		$this->set('count', $this->Text->crawl());
	}

}
?>

<?php
class TextsController extends AppController {

	var $name = 'Texts';
	var $models = array("TextChangeAction");

	function index() {
		$this->set('text', $this->TextChangeAction -> getRangeData());
	}

}
?>

<?php
class TextsController extends AppController {

	var $name = 'Texts';
	var $uses = array("TextChangeAction");

	function index() {
		$this->set('text', $this->TextChangeAction -> getRangeData(1,1,1,3));
	}

}
?>

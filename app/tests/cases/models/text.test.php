<?php
App::import('Model', 'Text');

class TextTestCase extends CakeTestCase {
	var $fixtures = array('app.text');

	function startTest() {
		$this->Text =& ClassRegistry::init('Text');
	}

	function endTest() {
		unset($this->Text);
		ClassRegistry::flush();
	}

}
?>

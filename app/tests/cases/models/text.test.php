<?php
App::import('Model', 'Text');

class TextTestCase extends CakeTestCase {
	var $fixtures = array('app.text');
	function testCrawl(){
		/*
		$count = $this -> Text -> crawl();
		$this -> assertTrue($count>0);
		$this -> assertEqual($count,$this -> Text -> find('count'));
		 */
	}

	function testFind(){
		$this -> assertTrue($this -> Text -> find('count') > 0 );
		$text = $this -> Text -> findById(2);
		$this -> assertNotNull($text);
		$this -> assertNotNull($text['Text']);
		$this -> assertEqual(2,$text['Text']['id']);
		$this -> assertNotNull($text['Text']['english']);
		$this -> assertNotNull($text['Text']['japanese']);
	}
	function testFindByRange(){
		$start = 50;
		$end   = 100;
		for($i = -55; $i<=$end-$start+55;$i++){
			$text = $this -> Text -> findByRange($start,$end,$i);
			$this -> assertNotNull($text);
			$this -> assertFalse(empty($text));
			$this -> assertTrue(
				$text["Text"]["id"] >= $start && 
				$text["Text"]["id"] <= $end
			);
		}

		$text = $this -> Text -> findByRange(0,0,0);
		$this -> assertTrue(1,$text['Text']['id']);

		$last = $this -> Text ->find('count');

		$text = $this -> Text -> findByRange($last,$last,1);
		$this -> assertTrue($last,$text['Text']['id']);

		$text = $this -> Text -> findByRange($last,$last+50,1);
		$this -> assertTrue($last,$text['Text']['id']);
	}
	function startTest() {
		echo "START..";
	}

	function endTest() {
		echo "END\n";
	}
	function startCase() {
		$this->Text =& ClassRegistry::init('Text');
	}

	function endCase() {
		unset($this->Text);
		ClassRegistry::flush();
	}

}
?>

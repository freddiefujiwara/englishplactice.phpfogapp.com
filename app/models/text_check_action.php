<?php
class TextCheckAction extends AppModel {
	var $name = 'TextCheckAction';
	var $useTable = false;
	var $ngList = array(
		"a","the",
		"I","you","he","she","it","we","you","they","this","that",
		"my","your","his","her","its","our","your","their",
		"me","you","him","her","it","us","you","them",
		"mine","yours","his","hers",
		"ours","yours","theirs",
	);
	var $validate = array();
	function getRangeData($start,$end,$step,$num_question){
		$this->Text =& ClassRegistry::init('Text');
		$text = $this -> Text -> findByRange($start,$end,$step);
		$splitted = preg_split("/[^a-zA-Z'-]/",strtolower(trim($text["data"]["Text"]["english"])),-1,PREG_SPLIT_NO_EMPTY);
		$indexes = array();
		foreach($splitted as $index => $word){
			if(in_array($word,$this -> ngList)){continue;}
			$indexes[] = $index;
		}
		if($num_question>count($indexes)){$num_question = count($indexes);}
		$question_indexes = array();
		foreach(array_rand($indexes,$num_question) as $index){
			$question_indexes[] = $indexes[$index];
		}

		$text["question"] = array(
			"splitted" => $splitted,
			"indexes"  => $question_indexes
		);
		return $text;
	}
	function setValidate($splitted,$indexes){
		$this -> validate = array();
		foreach($indexes as $index){
			$this -> validate["question$index"] = array(
				'noBlank' => array(
					'rule' => array('notEmpty'),
					'required' => true,
					'message' => 'required'
				),
				'equalTo' => array(
					'rule' => array('equalTo',$splitted[$index]),
					'message' => 'wrong'
				)
			);
		}
	}
}
?>

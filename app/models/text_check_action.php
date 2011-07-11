<?php
class TextCheckAction extends AppModel {
	var $name = 'TextCheckAction';
	var $useTable = false;
	var $ngList = array(
		"a","the",
		"i","you","he","she","it","we","you","they","this","that",
		"my","your","his","her","its","our","your","their",
		"me","you","him","her","it","us","you","them",
		"mine","yours","his","hers",
		"ours","yours","theirs",
		"are","am","is","were","was",
		"and"
	);
	var $validate = array();
	function getRangeData($start,$end,$step,$questions){
		$this->Text =& ClassRegistry::init('Text');
		$text = $this -> Text -> findByRange($start,$end,$step);
		$splitted = preg_split("/[^a-zA-Z'-]/",strtolower(trim($text["data"]["Text"]["english"])),-1,PREG_SPLIT_NO_EMPTY);
		$indexes = array();
		foreach($splitted as $index => $word){
			if(in_array($word,$this -> ngList)){continue;}
			$indexes[] = $index;
		}
		if($questions>count($indexes)){$questions = count($indexes);}
		$rands = array_rand($indexes,$questions);
		foreach(is_array($rands) ? $rands : array($rands) as $index){
			$question_indexes[] = $indexes[$index];
		}

		$text["question"] = array(
			"splitted" => $splitted,
			"indexes"  => $question_indexes
		);
		$text["questions"] = $questions;
		return $text;
	}
	function setValidate($splitted,$indexes){
		$this -> validate = array();
		foreach($indexes as $index){
			$this -> validate["question$index"] = array(
				'noBlank' => array(
					'rule' => array('notEmpty'),
					'required' => true,
					'message'  => " "
				),
				'equalTo' => array(
					'rule' => array('custom',"/^\s*$splitted[$index]\s*$/i"),
					'message'  => " "
				)
			);
		}
	}
}
?>

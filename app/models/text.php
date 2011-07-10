<?php
class Text extends AppModel {
	function crawl(){
		$curl = curl_init("http://englishplactice.appspot.com/apis/texts.js");
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
		$texts = json_decode(curl_exec($curl));
		foreach($texts as $text){
			$this -> save(
				array(
					'Text' => array(
						'id' => $text->id,
						'japanese' => $text->japanese,
						'english' => $text->english
					)
				)
			);
		}
		return count($texts);
	}
	function findByRange($start,$end,$step){

		$start= intval($start);
		if($start<1){$start = 1;}

		$end  = intval($end);
		$last = $this -> find('count');
		if($end > $last){$end = $last; }

		if($start>$end){$start=$end;}

		$step = intval($step);
		$step %= ($end - $start+1);
		if($step < 1){
			$step = $end - $start + 1 + $step;
		}

		return array('start' => $start, 
			'end' => $end, 
			'step' => $step, 
			'data' => $this -> findById($start + $step - 1));
	}
	var $name = 'Text';
	var $validate = array(
		'id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'english' => array(
			'noBlank' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'japanese' => array(
			'noBlank' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
}
?>

<?php
class TextsComponent extends Object
{
	function startup(&$controller){
		foreach(array('start','end','questions','step') as $key){
			if(!array_key_exists($key,$controller -> params)){
				$controller -> params[$key] = 1;
			}
		}
		$text = $controller->TextCheckAction -> getRangeData(
			intval($controller -> params["start"]),
			intval($controller -> params["end"]),
			intval($controller -> params["step"]),
			intval($controller -> params["questions"])
		);
		if(!is_null($controller -> data) && array_key_exists("TextCheckAction",$controller -> data) &&
				array_key_exists("indexes",$controller -> data["TextCheckAction"])){
			$text["question"]["indexes"] = explode(",",$controller -> data["TextCheckAction"]["indexes"]);
			unset($controller -> data["TextCheckAction"]["indexes"]);
		}
		$controller->set('text', $text);
	}
}

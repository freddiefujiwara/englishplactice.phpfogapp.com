<?php
class TextsComponent extends Object
{
	function startup(&$controller){
		foreach(array('start','end','questions','step') as $key){
			if(!array_key_exists($key,$controller -> params)){
				$controller -> params[$key] = 1;
			}
			$controller -> params[$key] = intval($controller -> params[$key]);
		}
		$text = $controller->TextCheckAction -> getRangeData(
			$controller -> params["start"],
			$controller -> params["end"],
			$controller -> params["step"],
			$controller -> params["questions"]
		);
		if(!is_null($controller -> data) && array_key_exists("TextCheckAction",$controller -> data) &&
				array_key_exists("indexes",$controller -> data["TextCheckAction"])){
			$text["question"]["indexes"] = explode(",",$controller -> data["TextCheckAction"]["indexes"]);
			unset($controller -> data["TextCheckAction"]["indexes"]);
		}
		$controller->set('text', $text);
		$controller->set('max' , $controller->Text->find("count"));
	}
}

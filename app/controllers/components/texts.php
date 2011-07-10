<?php
class TextsComponent extends Object
{
	function startup(&$controller){
		foreach(array('start','end','questions','step') as $key){
			if(!array_key_exists($key,$controller -> params)){
				$controller -> params[$key] = 1;
			}
		}
	}
}

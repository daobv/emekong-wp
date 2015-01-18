<?php
class javo_array{
	var $args;
	public function __construct($args){
		if(empty($args)){ return false; };
		$this->args = $args;
	}
	public function get($index=null, $default=""){
		if(empty($index)){ return $default; };
		return !empty($this->args[$index]) ? $this->args[$index] : $default;
	}
}
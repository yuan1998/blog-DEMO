<?php 

class Validated{
	public function maxlength($str,$length){
		return (strlen($str) < $length);
	}

	public function minlength($str,$length){
		return (strlen($str) > $length);
	}
}
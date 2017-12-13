<?php
class Tags extends Model{
	public $pdo;
	public $table = 'tags';

	public function __construct($a){
		$this->pdo = $a;
	}

	public function add($param){
		$r = $this->_add($param);
		return $r ? s() : e('error');
	}

	public function read($par){
		$r = $this->_read($par);
		return $r;
	}
	
	public function test(){
		$this->multiAdd([['title'=>'asd','aid'=>'5'],['title'=>'asd','aid'=>'5'],['title'=>'asd','aid'=>'5']]);
	}
}
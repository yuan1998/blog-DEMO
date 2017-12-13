<?php

class Article extends Model{
	public $pdo;
	public $table = 'article';
	public $rule = [
		'title'=>'maxlength:60|minlength:8',
	];

	public function __construct($pdo){
		$this->pdo = $pdo;
	}

	public function add($p){
		$data = [
			'title' =>$p['title'],
			'content'=>$p['content'],
			'author'=>$p['author'],
			'author_id'=>$_SESSION['user']['id'],
			'regtime'=>time(),
		];

		return $this->_add($data) ? s($this->pdo->lastInsertId()) : e('error.');
	}

	public function update($p){
		// $old = $this->id_read($p['id'])['data'][0];
		if(!$this->id_read($p['id'])['data'][0])
			return e('id 有误.');
		$p['updatetime'] = time();
		$r = $this->_update($p);
		return $r ? s() : e('失败.');
	}

	public function remove($p){
		if(!$this->id_read($p['id'])['data'][0])
			return e('id 有误.');
		$r = $this->_update(['id'=>$p['id'],'updatetime'=>time(),'visible'=>0]);
		return $r ? s() : e('失败.');
	}

	public function read($p){
		$page = $p['page'] ?: 1;
		$limit = $p['limit'] ?: 10;
		$r = $this->_read(['page'=>$page,'limit'=>$limit]);
		return s($r);
	}

	public function id_read($p){
		$id = @$p['id'] ?: $p;
		if(!$id)
			return false;
		$r = $this->_read(['id'=>$id]);
		return s($r);
	}

	public function test(){
		$this->multiAdd([['title'=>'asd','aid'=>'5'],['title'=>'asd','aid'=>'5'],['title'=>'asd','aid'=>'5']]);
	}
}
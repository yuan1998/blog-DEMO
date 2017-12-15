<?php

class User extends Model{
	public $table = 'user';
	public $pdo;
	public function __construct($pdo){
		$this->pdo = $pdo;
	}
	
	public function login($p){
		$user = $this->userVerify(['username'=>$p['username'],'password'=>$this->hash_password($p['password'])]);
		if(!$user)
			return e('用户名或密码有误.');
		if($user['permission'] == 0)
			return e('用户已被封禁.');
		$_SESSION['user']=$user;
		return s();
	}

	public function signup($p){
		if(!$p['username'] || $this->usernameExists($p['username']))
			return e('用户名已存在.');
		if(!$p['email'] || $this->emailExists($p['email']))
			return e('邮箱已存在.');
		if(!$p['password'])
			return e('密码有误.');
		$data = [
			'username'=>$p['username'],
			'password'=>$this->hash_password($p['password']),
			'regtime'=>time(),
			'email'=>$p['email'],
		];
		$r = $this->_add($data);
		return $r ? s() : e('未知.');
	}

	public function userVerify($p){
		return $this->_read(['where'=>$p])[0];
	}

	public function usernameExists($name){
		return (bool)$this->_read(['where'=>['username'=>$name]])[0];
	}

	public function hash_password($password){
		return md5(md5($password).'yuan');
	}
}
<?php

function dd($arr){
	if(is_array($arr)){
		foreach ($arr as $key) {
			var_dump($key);
		}
	}else{
		var_dump($arr);
	}
	die();
}

function e($str=null){
	return ['success'=>false,'msg'=>$str];
}
function s($data=null){
	return ['success'=>true,'data'=>$data];
}

function json($r){
	header('Content-Type: application/json');
	return json_encode($r);
}

function new_pdo(){
	$dsn = 'mysql:host=127.0.0.1;prot=3306;dbname=blog';
	$user = 'test1';
	$password = '123';
	$options = [
	    PDO::ATTR_CASE => PDO::CASE_NATURAL, 
	    /*PDO::CASE_NATURAL | PDO::CASE_LOWER 小写，PDO::CASE_UPPER 大写， */
	    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
	    /*是否报错，PDO::ERRMODE_SILENT 只设置错误码，PDO::ERRMODE_WARNING 警告级，如果出错提示警告并继续执行| PDO::ERRMODE_EXCEPTION 异常级，如果出错提示异常并停止执行*/
	    PDO::ATTR_ORACLE_NULLS => PDO::NULL_NATURAL, 
	    /* 空值的转换策略 */
	    PDO::ATTR_STRINGIFY_FETCHES => false, 
	    /* 将数字转换为字符串 */
	    PDO::ATTR_EMULATE_PREPARES => false, 
	    /* 模拟语句准备 */
	];
	return new PDO($dsn,$user,$password,$options);	
}

function tpl_name($uri){
	return dirname(__FILE__). '/../../'.$uri.'.php';
}

function tpl($uri){
	require_once(tpl_name($uri));
}

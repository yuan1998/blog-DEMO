<?php
	tpl('api/Validated');
	tpl('api/Model');
	tpl('api/user');
	tpl('api/article');
	tpl('api/tags');



function getParams($uri){
	$uri = trim(trim($uri,'a'),'/');
	$uri = explode('?',$uri)[0];

	$uri = explode('/',$uri);
	$model = $uri[0];

	$method = $uri[1];

	if(!class_exists(ucfirst($model))){
		return 'error1';
	}

	$d = new $model(new_pdo());

	if(!method_exists($d,$method))
		return 'error2';
	$param = array_merge($_GET,$_POST);
	return $d->$method($param);
}

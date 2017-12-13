<?php 
  session_start();
  require_once('util/component/helper.php');
  tpl('api/gateway');

  $uri = $_SERVER['REQUEST_URI'];

  if(strpos($uri,'/a/') !== false){
    echo json(getParams(trim($uri,'/')));
    die();
  }


  switch($uri){
  	case '/':
  		tpl('ui/page/home');
  		break;
    case '/article/editor':
      tpl('ui/page/editor');
      break;
  	default:
  		tpl('ui/page/404');
  		break;
  }
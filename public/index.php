<?php
  session_start();
  require_once('../util/component/helper.php');
  tpl('api/gateway');

  $uri = $_SERVER['REQUEST_URI'];

  if(strpos($uri,'/a/') !== false){
    echo json(getParams(trim($uri,'/')));
    die();
  }
  $uri = explode('?',$uri)[0];

  switch($uri){
  	case '/':
  		tpl('ui/page/profile');
  		break;
    case 'article/editor':
      tpl('ui/page/editor');
      break;
    case 'article/info':
      tpl('ui/page/article.info');
      break;
  	default:
  		tpl('ui/page/404');
  		break;
  }

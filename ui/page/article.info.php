<?php 
	
	$article = new Article(new_pdo());
	$data = $article->id_read($_GET['id'])['data'][0];

	if(!isset($_GET['id'])||!$data||$data['visible']==0){
		tpl('/ui/page/404');
		die();
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $data['title']." - BLOG" ?></title>
	<link rel="stylesheet" href="/ui/css/articleInfo.css">
	<?php tpl('/util/component/util-js'); ?>
	<script src="/ui/js/article.info.js"></script>
</head>
<body>
	<div class="wrapper">
		<div class="row">
			<div class="col col-2"></div>
			<div class="col col-8" id="articleContent"></div>
		</div>
	</div>
	<div id="backBtn">
		
	</div>
</body>
</html>
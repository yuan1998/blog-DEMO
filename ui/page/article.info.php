<?php 
	
	$article = new Article(new_pdo());
	$data = $article->id_read($_GET['id'])['data'][0];

	if(!isset($_GET['id'])||!$data){
		tpl('/ui/page/404');
		die();
	}
	var_dump($data);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $data['title']." - BLOG" ?></title>
	<?php tpl('/util/component/util-js'); ?>
	<script src="/ui/js/article.info.js"></script>
</head>
<body>
	<div>
		<div class="articleInfo">
			<?php
				echo "<h3>$data['title']</h3>
					
				"
			?>
		</div>
	</div>
	<div>
		<h3>$data['title']</h3>
		<ul>
			<li>发表于:date('Y-m-d'){date('Y-m-d',$data[''])}</li>
		</ul>
	</div>
</body>
</html>
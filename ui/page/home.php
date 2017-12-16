<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>「LIFE」</title>
	<link rel="stylesheet" href="/ui/css/home.css">
	<?php tpl('/util/component/util-js'); ?>
	<script src="/ui/js/tag-bar.js"></script>
	<script src="/ui/js/home.js"></script>
</head>
<body>
	<div class="row wrapper">
		<div class="row">
			<h3 class="col col-12" id="homeTitle">HEELO.WORD!</h3>
		</div>
		<div class="row">
			<div id="articleWrap" class="col col-9"></div>
			<?php tpl('/util/component/tag-bar'); ?>
		</div>	
	</div>
	
</body>
</html>
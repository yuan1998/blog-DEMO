<!DOCTYPE html>
<html lang="zh-cn">
<head>
	<meta charset="UTF-8">
	<title>「EDIT」</title>
	<script src="/util/js/jquery.js"></script>
	<script src="/ui/js/editor.js"></script>
</head>
<body>
	<h3>发表</h3>
	<div>
		<form id="articleForm">
			<input type="text" name="title"><br>
			<textarea name="content" cols="30" rows="10"></textarea><br>
			<select name="author">
				<?php $name= $_SESSION['user']['username'];
				echo "<option value='$name'>$name</option>";
				?>
				<option value="匿名">匿名</option>
			</select>
			<ul class="tagList"></ul>
			<button type="submit">发表</button>
		</form>
	</div>
	
</body>
</html>
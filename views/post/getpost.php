<?php
use yii\helpers\Url;
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <title>Document</title>
</head>
<body>
 <p>html</p>
	<form action="<?= Url::to(['post/select-post'])?>" method="post">
		<label>标题</label><input type="text" name="title" value="" />
		<label>内容</label><input type="text" name="content" value="" />
		<label>作者</label><input type="text" name="author" value="" />
		<input type="submit" value="查询" />
	</form>
</body>
</html>
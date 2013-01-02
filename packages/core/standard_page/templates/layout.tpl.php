<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title><?php echo $title; ?></title>
		<?php hook::execute('html_head'); ?>
	</head>
	<body>
		<?php echo $body; ?>
	</body>
</html>

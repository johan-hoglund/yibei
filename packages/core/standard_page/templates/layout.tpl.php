<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title><?php echo $title; ?></title>
		<link href='http://fonts.googleapis.com/css?family=Doppio+One|Open+Sans|Crimson+Text' rel='stylesheet' type='text/css'>
		<?php hook::execute('html_head'); ?>
	</head>
	<body>
		<?php echo $body; ?>
	</body>
</html>

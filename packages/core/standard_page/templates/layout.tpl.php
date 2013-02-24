<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title><?php echo $title; ?></title>
		<link href='http://fonts.googleapis.com/css?family=Doppio+One|Open+Sans|Crimson+Text|Noticia+Text|Roboto+Condensed' rel='stylesheet' type='text/css'>
		<?php hook::execute('html_head'); ?>
		<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	</head>
	<body>
		<?php echo $body; ?>
	</body>
</html>

<?php

	$pkg['version'] = 0.1;
	$pkg['type'] = 'base';
	$pkg['author'] = 'johan.hoglund@jhoglund.se';
	$pkg['description'] = '
	Enables usage of JS files. Hooks in to "html_head_tags" to include a link
	to /stylesheet-timestamp.js. When the js file is required by the browser,
	a merge of all css files found under the /packages directory is served.
	';
	$pkg['suggested-packages'] = array('cache' => 0.1);
	$pkg['use-with'] = array('standard_page' => 0.1);
	$pkg['requires'] = array('jsmin' => 0.1, 'page' => 0.1);

?>

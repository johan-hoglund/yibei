<?php

	$pkg['version'] = 0.1;
	$pkg['type'] = 'base';
	$pkg['author'] = 'johan.hoglund@jhoglund.se';
	$pkg['description'] = '
	Enables usage of CSS files. Hooks in to "html_head_tags" to include a link
	to /stylesheet-timestamp.css. When the css file is required by the browser,
	a merge of all css files found under the /packages directory is served.
	';
	$pkg['requires'] = array('page' => 0.1);

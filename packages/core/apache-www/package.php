<?php

	$pkg['version'] = 0.1;
	$pkg['type'] = 'base';
	$pkg['author'] = 'johan.hoglund@jhoglund.se';	
	$pkg['description'] = '
	Provides an entry point for incoming www connections to Apache.
	Implements a simple bidding process to determine which page gets
	to process the request. Set the apache document root to the URL where
	this package is located.
	';
	$pkg['requires'] = array('hook' => 0.1, 'debug' => 0.1);
	
?>

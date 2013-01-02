<?php

	$pkg['version'] = 0.1;
	$pkg['type'] = 'base';
	$pkg['author'] = 'johan.hoglund@jhoglund.se';	
	$pkg['description'] = '
	Loads a template, feeding it with desired data and returns the result
	as a string. Current implementation looks for a template with the
	extension .tpl.php in the callers directory, if it isn\'t found it
	tries to find the template in the callers package template directory.
	';
	
?>
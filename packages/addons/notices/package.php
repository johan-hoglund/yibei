<?php

	$pkg['version'] = 0.1;
	$pkg['type'] = 'base';
	$pkg['author'] = 'johan.hoglund@jhoglund.se';
	$pkg['description'] = '
	Should provide notices
	';
	$pkg['suggested-packages'] = array('standard_page' => 0.1);
	$pkg['use-with'] = array('apache-www' => 0.1, 'hook' => 0.1);
	$pkg['requires'] = array('hook' => 0.1);

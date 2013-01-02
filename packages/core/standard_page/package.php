<?php

	$pkg['version'] = 0.1;
	$pkg['type'] = 'base';
	$pkg['author'] = 'johan.hoglund@jhoglund.se';	
	$pkg['description'] = '
	Provides an implementation of the "page" interface, all standard
	web pages SHOULD extend this class. Since this class should have
	updates seldomly, you MAY edit it to fit your needs.';
	$pkg['requires'] = array('page' => 0.1);

?>
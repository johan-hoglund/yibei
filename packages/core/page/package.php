<?php

	$pkg['version'] = 0.1;
	$pkg['type'] = 'base';
	$pkg['author'] = 'johan.hoglund@jhoglund.se';
	$pkg['description'] = '
	Base package interface. All web pages should extend this call in order
	to be able to place bids in the apache-www bidding process.
	';
	$pkg['suggested-packages'] = array('standard_page' => 0.1);
	$pkg['use-with'] = array('apache-www' => 0.1);

?>

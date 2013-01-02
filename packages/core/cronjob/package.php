<?php

	$pkg['version'] = 0.1;
	$pkg['type'] = 'interface';
	$pkg['author'] = 'johan.hoglund@jhoglund.se';	
	$pkg['description'] = '
	Simple cronjob interface. Set up your cronjob (crontab, vixiecron...)
	to execute "minute.php" once a minute. Other packages may register
	hooks to have certain functions executed at regular intervals.
	';

	$pkg['requires'] = array('hook' => 0.1);
	
?>
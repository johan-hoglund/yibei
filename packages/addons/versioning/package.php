<?php

	$pkg['version'] = 0.1;
	$pkg['author'] = 'johan.hoglund@jhoglund.se';	
	$pkg['description'] = '
	Allows distribution of static content, such as image files and such. When this package is 
	active, you can create a folder called "static" in a package and all files and folders placed
	in that folder will be accessible at the url /static/PACKAGE_NAME/.
	';
	$pkg['requires'] = array('base_classes' => 0.1);

?>

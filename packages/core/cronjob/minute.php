#!/usr/bin/php
<?php
	include(dirname(__FILE__) . '/../../engine.php');
	hook::execute('cronjob_minute');
	debug::log('Cronjob!');

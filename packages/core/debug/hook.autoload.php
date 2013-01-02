<?php
	if(defined('DEBUG_SHOW') && DEBUG_SHOW)
	{
		hook::register('layout_main_close', array('class' => 'debug', 'method' => 'render'));
	}

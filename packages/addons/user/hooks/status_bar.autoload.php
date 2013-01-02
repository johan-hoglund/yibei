<?php
	hook::register('bidding', array('class' => 'user', 'method' => 'load_current'));
	hook::register('last_call', array('class' => 'user', 'method' => 'save_current'));
	
	hook::register('page_head', function() {
		if(user::current()->get('signed_in')) {
			echo template('status_bar', array('user' => user::current()));
		}
	});
	
	

<?php
	class page_sign_in extends standard_page
	{
		public static function get_url_pattern()
		{
			return array('bid' => 5, 'regexp' => '#^/user/sign-in$#');
		}
		
		function execute($uri)
		{
			$user = new user();
			$user->set('name', $_POST['name']);
			$user->set('signed_in', true);
			user::set_current($user);
			notice::add(array('heading' => 'Welcome', 'text' => 'You have now signed in', 'class' => 'success'));
				$this->redirect = '/';
		}
	}
?>

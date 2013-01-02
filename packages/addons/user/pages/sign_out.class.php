<?php
	class page_sign_out extends standard_page
	{
		public static function get_url_pattern()
		{
			return array('bid' => 5, 'regexp' => '#^/user/sign-out$#');
		}
		
		public function execute($uri)
		{
			user::set_current(new user());
			notices_add('Signed out!', 'You have now been signed out');
			$this->redirect = '/';
		}
	}
?>

<?php
	class UserLogout extends yibei_page
	{
		public static function get_url_pattern()
		{
			return array('#^/logga-ut$#' => 10);
		}

		public function execute($uri)
		{
			User::current()->sign_out();
			$this->content = template('logged_out');
		}
	}

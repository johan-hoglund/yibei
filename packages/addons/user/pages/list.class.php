<?php
	class page_user_list extends standard_page
	{
		public static function get_url_pattern()
		{
			return array('bid' => 5, 'regexp' => '#^/user/list$#');
		}
		
		function execute($uri)
		{
			$this->content = template('list', array('users' => user::fetch()));
			
			$this->content .= '<p><a href="/user/create/">Create new user</a></p>';
		}
	}
?>

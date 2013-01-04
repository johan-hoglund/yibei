<?php
	class facebook_channel_file implements page
	{	
		public static function get_url_pattern()
		{
			return array('#^/facebook_channel\.html$#' => 10);
		}
		
		public static function accepts($uri)
		{
			return true;
		}
		
		public function output($uri)
		{
			echo '<script src="//connect.facebook.net/en_US/all.js"></script>';
		}		
	}


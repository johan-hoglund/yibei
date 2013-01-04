<?php
	class static_file implements page
	{

		public static function get_url_pattern()
		{
			return array('#/static/([a-zA-Z_\-0-9]*)/(.*)#' => 5);
		}

		public static function accepts($uri)
		{
			return true;
		}

		public static function url_hook($uri)
		{
			// Dont allow people why try to traverse upwards or "home" in the file tree
			if(strpos($uri, '..') || strpos($uri, '~'))
			{
				return 0;
			}

			$pattern = '#/static/([a-zA-Z_\-0-9]*)/(.*)#';
			if(preg_match($pattern, $uri, $result))
			{
				if(is_readable(PATH_PACKAGES . $result[1] . '/static/' . $result[2]))
				{
					return 10;
				}
			}
			return 0;
		}
		
		public function output($uri)
		{
			if(!strpos($uri, '..') && !strpos($uri, '~'))
			{
				$pattern = '#/static/([a-zA-Z_\-0-9]*)/(.*)#';
				if(preg_match($pattern, $uri, $result))
				{
					$file = PATH_PACKAGES . 'yibei/' . $result[1] . '/static/' . $result[2];
					if(is_readable($file))
					{
						header('Cache-Control: private, max-age=10800, pre-check=10800');
						header('Pragma: private');
						header('Expires: ' . date(DATE_RFC822,strtotime(' 2 day')));

						header('Content-type: ' . fs_tools::content_type($result[2]));
						readfile($file);
						return;
					}
				}
			}
			die('Here should be error handling!');
		}	
	}

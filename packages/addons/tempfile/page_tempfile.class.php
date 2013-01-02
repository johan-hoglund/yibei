<?php
	class page_tempfile implements page
	{	
		public static function get_url_pattern()
		{
			return array('bid' => 5, 'regexp' => '#^/temp/.*#');
		}
		
		public static function accepts($uri)
		{
			return true;
		}
		
		public function output($uri)
		{
			$pattern = '#/temp/(.*)' . '#';
			preg_match($pattern, $uri, $matches);
			if($tempfile = tempfile::from_filename($matches[1]))
			{
				header('Content-type: ' . fs_tools::content_type($tempfile->get_path()));
				readfile($tempfile->get_path());
			}
			else
			{
				throw new Exception('Could not load tempfile from filename');
			}
		}		
	}


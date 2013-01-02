<?php
	class page_css implements page
	{
		
		public static function accepts($uri)
		{
			return true;
		}

		public static function get_url_pattern()
		{
			return array('#^/style.css$#' => 5);
		}
		
		public function output($uri)
		{
			header('Cache-Control: private, max-age=10800, pre-check=10800');
			header('Pragma: private');
			header('Expires: ' . date(DATE_RFC822,strtotime(' 2 day')));
			header('Content-type: text/css');
			$files = fs_tools::find_files(PATH_PACKAGES, array('extension' => 'css'));
			foreach($files AS $file)
			{
				echo '/*' . $file . "*/\n";
				include(PATH_PACKAGES . $file);
			}
		}
		
		public static function style_tag()
		{
			echo '<style type="text/css">' . "\n";
			echo '@import url("/style.css");' . "\n";
			echo '</style>' . "\n";
		}

		public static function background($from, $to)
		{
			return 'background: ' . $from . ';'
			. "\n\t" . 'filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="' . $from . '", endColorstr="' . $to . '");'
			. "\n\t" . 'background: -webkit-gradient(linear, left top, left bottom, from(' . $from . '), to(' . $to . '));'
			. "\n\t" . 'background: -moz-linear-gradient(top,  ' . $from . ',  ' . $to . ');';
		}
	}
	
	hook::register('html_head', array('class' => 'page_css', 'method' => 'style_tag'));


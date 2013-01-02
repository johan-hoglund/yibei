<?php
	class imagecrop_all_images_json implements page
	{
		protected $content;

		public static function get_url_pattern()
		{
			return array('#/imagecrop/all_images.json#' => 5);
		}
		
		public function execute($uri)
		{
		}
		
		public function output($uri)
		{
			header('Cache-control: no-store');
			$handle = opendir(imagecrop::storage_path());
			$images = array();
			while($file = readdir($handle))
			{
				if($file != '.' && $file != '..')
				{
					$info = getimagesize(imagecrop::storage_path() . $file);
					$images[$file] = array('width' => $info[0], 'height' => $info[1], 'mtime' => filemtime(imagecrop::storage_path() . $file));
				}
			}

			$mysorter = function($a, $b) {
				if($a['mtime'] == $b['mtime'])
				{
					return 0;
				}
				return ($a['mtime'] > $b['mtime']) ? -1 : 1;
			};

			uasort($images, $mysorter);

			echo json_encode($images);
		}
	}
	

<?php
	class imagecrop_output implements page
	{
		protected $content;

		public static function get_url_pattern()
		{
			$bids = array();
			$bids['#/imagecrop/[a-z0-9-_\.]*/[0-9]*\+[0-9]*_[0-9]*\+[0-9]*/[0-9]*x[0-9]*(!?).png#'] = 5;
			$bids['#/imagecrop/[a-z0-9-_\.]*/[0-9]*x[0-9]*(!?).png#'] = 5;

			return $bids;
		}
		
		public function execute($uri)
		{
		}
		
		public function output($uri)
		{
			header('Cache-control: public');
			header('Expires: Tue, 1 Dec 2020 15:15:15 GMT');
			header('Pragma: cache');

			$crop_pattern = '#/imagecrop/([a-z0-9-_\.]*)/([0-9]*)\+([0-9]*)_([0-9]*)\+([0-9]*)/([0-9]*)x([0-9]*)(!?).png#';
			$resize_pattern = '#/imagecrop/([a-z0-9-_\.]*)/([0-9]*)x([0-9]*)(!?).png#';
			
			$options = array();

			if(preg_match($crop_pattern, $uri, $matches))
			{
				list($url, $handle, $options['x1'], $options['x2'], $options['y1'], $options['y2'], $options['w'], $options['h'], $options['fixed']) = $matches;
			}
			elseif(preg_match($resize_pattern, $uri, $matches))
			{
				list($url, $handle, $options['w'], $options['h'], $options['fixed']) = $matches;
			}
			
			$options['fixed'] = (isset($options['fixed']) && $options['fixed'] == '!') ? true : false;

			if($imagecrop = imagecrop::load($handle))
			{
				$imagecrop->output($options);
			}
		}
	}
	

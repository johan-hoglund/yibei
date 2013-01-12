<?php
	
	class imagecrop extends fetcher
	{
		protected static $db_name = 'imagecrops';
		public static $fields = array('handle', 'x1', 'x2', 'y1', 'y2');


		public function selector($options = array())
		{
			$options['width'] = isset($options['width']) ? $options['width'] : 100;

			return template('selector', array('crop' => $this, 'options' => $options));
		}

		public function update_from_postdata($postdata)
		{
			foreach(array('x1', 'x2', 'y1', 'y2', 'handle') AS $key)
			{
				if(isset($postdata[$key]))
				{
					$this->$key = $postdata[$key];
				}
			}
		}

		public function db_decode_x1($data)
		{
			$this->x1 = ($data > 0) ? $data : 0;
		}

		public function __construct($handle = null)
		{
			if(isset($handle))
			{
				$this->handle = $handle;
			}
		}

		public function exists()
		{
			return (isset($this->handle) && (strlen($this->handle) > 0));
		}

		public static function load($handle)
		{
			$crop = new imagecrop();	
			$crop->set('handle', $handle);
			return $crop;
		}

		private function fix_dir()
		{
			if(!is_dir(PATH_CACHE . 'imagecrop'))
			{
				if(!mkdir(PATH_CACHE . 'imagecrop'))
				{
					throw new Exception('Could not create image cache directory: ' . PATH_CACHE . 'imagecrop');
				}
			}
		}

		public function storage_path()
		{
			$path = PATH_STORAGE . 'imagestore/';
			if(!is_dir($path))
			{
				if(!mkdir($path))
				{
					throw new Exception('Could not create image storage directory: ' . $path);
				}
			}
			return $path;
		}

		public function image_url($options = array('w' => 500, 'h' => 400))
		{
			if(!isset($options['h']))
			{
				$options['h'] = 999;
			}
			return '/imagecrop/' . $this->handle . '/' . $this->x1 . '+' . $this->x2 . '_' . $this->y1 . '+' . $this->y2 . '/' . $options['w'] . 'x' . $options['h'] . '.png';
		}

		public function output($options)
		{
			self::fix_dir();
			$raw = self::storage_path() . $this->handle;
			
			$size = getimagesize($raw);

			$options['w'] = isset($options['w']) ? $options['w'] : $size[0];
			$options['h'] = isset($options['h']) ? $options['h'] : $size[1];

			$options['x2'] = isset($options['x2']) ? $options['x2'] : $size[0];
			$options['x1'] = isset($options['x1']) ? $options['x1'] : 0;

			$options['y2'] = isset($options['y2']) ? $options['y2'] : $size[1];
			$options['y1'] = isset($options['y1']) ? $options['y1'] : 0;

			$crop_w = $options['x2'] - $options['x1'];
			$crop_h = $options['y2'] - $options['y1'];

			$x = $options['x1'];
			$y = $options['y1'];

			$scale_w = $options['w'];
			$scale_h = $options['h'];

			$fixed = $fixed ? '!' : '';

			$cache_file = PATH_CACHE . 'imagecrop/' . $this->handle . '-' . $x . '+' . $crop_w . '_' . $y . '+' . $crop_h . '-' . $scale_w . 'x' . $scale_h . '.png';
			
			if(!file_exists($cache_file))
			{
				$cmd = 'convert ' . $raw;
				$cmd .= ' -crop '.$crop_w.'x'.$crop_h.'+'.$x.'+'.$y;
				$cmd .= ' -scale '.$scale_w.'x'.$scale_h.$fixed.' ' . $cache_file;
				system($cmd);
			}
			header('Content-type: image/png');
			readfile($cache_file);
		}
	}



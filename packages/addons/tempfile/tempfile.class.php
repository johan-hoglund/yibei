<?php
	class tempfile extends setget
	{
		protected $filename;
		public static function from_path($path, $extension)
		{
			debug::log('Tempfile from path ' . $path, array('category' => 'imageversion'));
			$filename = md5(microtime(true) . rand(0, 999999)) . '.' . $extension;

			copy($path, PATH_TEMP . $filename);
			
			$tempfile = new tempfile();
			$tempfile->set('filename', $filename);
			
			return $tempfile;
		}

		public static function from_url($path, $extension)
		{
			$filename = md5(microtime(true) . rand(0, 999999)) . '.' . $extension;
			file_put_contents(PATH_TEMP . $filename, file_get_contents($path));
			
			$tempfile = new tempfile();
			$tempfile->set('filename', $filename);
			
			return $tempfile;

		}
		
		public static function from_content($content, $extension)
		{
			$filename = md5(microtime(true) . rand(0, 999999)) . '.' . $extension;
			file_put_contents(PATH_TEMP . $filename, $content);
			$tempfile = new tempfile();
			$tempfile->set('filename', $filename);
			
			return $tempfile;
		}
		
		public static function from_filename($filename)
		{
			debug::log('From file name' . $filename, array('category' => 'imageversion'));
			if(file_exists(PATH_TEMP . $filename))
			{
				$tempfile = new tempfile();
				$tempfile->set('filename', $filename);

				debug::log('File exists ' . $filename, array('category' => 'imageversion'));
				debug::log($tempfile, array('category' => 'imageversion'));
				return $tempfile;
			}
			return false;
		}
		
		public function __construct()
		{
			if(!is_dir(PATH_TEMP))
			{
				mkdir(PATH_TEMP);
			}
		}
		
		public function get_filename()
		{
			return $this->filename;
		}
		
		public function get_url()
		{
			return '/temp/' . $this->filename;
		}
		
		public function get_path()
		{
			return PATH_TEMP . $this->filename;
		}
	}
?>

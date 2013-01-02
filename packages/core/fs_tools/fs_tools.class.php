<?php
	
	class fs_tools
	{
		public static function find_files($dir, $options)
		{
			$options['recursive'] = (isset($options['recursive']) && $options['recursive'] === false) ? false : true;

			$files = scandir($dir);
			foreach($files AS $key => $file)
			{
				$extension = substr($file, strrpos($file, '.') + 1);
				if($file == '.' || $file == '..')
				{
					unset($files[$key]);
					continue;
				}
				
				if(is_dir($dir . $file))
		    {
		    	$subfiles = fs_tools::find_files($dir . $file . '/', $options);
		    	foreach($subfiles AS $subfile)
		    	{
		    		$files[] = $file . '/' . $subfile;
		    	}
		    	unset($files[$key]);
		    }
				elseif(isset($options['extension']) && $extension != $options['extension'])
				{
					unset($files[$key]);
					continue;
				}
			}
			return $files;
		}
		
		public static function content_type($filename)
		{
			$types['png'] = 'image/png';
			$types['jpg'] = 'image/jpeg';
			$types['pdf'] = 'application/pdf';
			$types['html'] = 'text/html; charset=utf-8';
			$types['css'] = 'text/css; charset=utf-8';
			$types['js'] = 'text/javascript; charset=utf-8';
			
			if(isset($types[self::file_extension($filename)]))
			{
				return $types[self::file_extension($filename)];
			}
			return 'application/x-unknown';
		}
		
		public static function file_extension($filename)
		{
			return strtolower(substr($filename, strrpos($filename, '.') + 1));
		}
		
		public static function rrmdir($dir)
		{
			if (is_dir($dir))
			{
				$objects = scandir($dir);
				foreach ($objects as $object)
				{
					if ($object != "." && $object != "..")
					{
						if (filetype($dir."/".$object) == "dir")
						{
							fs_tools::rrmdir($dir."/".$object);
						}
						else
						{
							unlink($dir."/".$object);
						}
					}
				}
				reset($objects);
				rmdir($dir);
			}
		} 
		
		public static function fetch_files_from_folder($dir)
		{
			$files = scandir($dir);
			foreach($files as $key => $file)
			{
				if($file == '.' || $file == '..')
				{
					unset($files[$key]);
				}
				if(is_dir($dir . $file) && $file != '.' && $file != '..')
		    {
		    	$subfiles = tools::fetch_files_from_folder($dir . $file . '/');
		    	foreach($subfiles as $subfile)
		    	{
		    		array_push($files, $file . '/' . $subfile);
		    	}
		    	unset($files[$key]);
		    }
			}
			return $files;
		}
	}
	
?>

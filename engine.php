<?php
	require_once __DIR__ . '/configuration.php';

	// Recursively find all subdirectories and include package definitions.
	// Note that package names (dir name) must be globally unique!
	$packages = array();
	$scanner = function($dir) use (&$scanner, &$packages) {
		foreach(scandir($dir) AS $subdir)
		{
			if($subdir{0} != 'i.' && is_file($pkgfile = $dir . $subdir . '/package.php'))
			{
				unset($pkg);
				include($pkgfile);
				$packages[$subdir] = $pkg;
				$packages[$subdir]['path'] = $dir . $subdir . '/';
				$packages[$subdir]['name'] = $subdir;
				$packages[$subdir]['requires'] = isset($packages[$subdir]['requires']) ? $packages[$subdir]['requires'] : array();
			}
			elseif(is_dir($dir . $subdir) && $subdir{0} != '.')
			{
				$scanner($dir . $subdir . '/');
			}
		}
	};
	$scanner(PATH_PACKAGES);

	$loaded = array();
	$tryload = function($name) use(&$packages, &$loaded, &$tryload) {
		if(!in_array($name, $loaded))
		{
			foreach($packages[$name]['requires'] AS $dep_name => $dep_ver)
			{
				$tryload($dep_name);
			}
			$it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($packages[$name]['path']));
			$files = array();
			while($it->valid())
			{
				foreach(array('.class.php', '.autoload.php', '.conf.php', '.hook.php', '.interface.php') AS $ext)
				{
					if(substr($it->getSubPathName(), -1*strlen($ext)) == $ext)
					{
						$files[] = $packages[$name]['path'] . $it->getSubPathName();
						break;
					}
				}
				$it->next();
			}
			foreach(array_unique($files) AS $file)
			{
				include($file);
			}
			$loaded[] = $name;
		}
	};

	foreach(array_keys($packages) AS $name)
	{
		$tryload($name);	
	}

	class package
	{
		public static function get_by_backtrace($trace)
		{
			$path = $trace[0]['file'];
			
			do
			{
				$path = substr($path, 0, strrpos($path, '/'));
				if(file_exists($path . '/package.php'))
				{
					return package::from_path($path . '/');
				}
			} while(strlen($path) > 0 && $i < 100);
		}

		public static function from_path($path)
		{
			$pkg = new package();
			$pkg->path = $path;
			return $pkg;
		}
	}



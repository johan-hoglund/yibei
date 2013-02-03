<?php
	class page_js implements page
	{

		public static function accepts($uri)
		{
			return true;
		}

		public static function get_url_pattern()
		{
			return array('#^/scripts.js$#' => 5);
		}
		
		public function output($uri)
		{
			header('Content-type: application/javascript');
			$files = fs_tools::find_files(PATH_PACKAGES, array('extension' => 'js'));

			$pool = array();
			foreach($files AS $key => $file)
			{
				$dependencies = array();
				ob_start();
				include(PATH_PACKAGES . $file);
				$scripts[$file] = ob_get_contents();
				ob_end_clean();
				$pool[$file] = $dependencies;
			}
			
			$ordered = array();
			$progress = true;
			while(count($pool) > 0 && $progress)
			{
				$progress = false;
				foreach($pool AS $file => $dependencies)
				{
					foreach($dependencies AS $dependency)
					{
						if(!in_array($dependency, $ordered))
						{
							continue 2;
						}
					}
					$ordered[] = $file;
					$progress = true;
					unset($pool[$file]);
				}
			}
			
			if($progress == false)
			{
				echo 'Circular/unsatisfied dependendcies, caused by: ';
				print_r($pool);
				echo "\n" . 'Ordered list is';
				print_r($ordered);
				exit;
			}
			
			echo "\n\n\n\n";
			foreach($ordered AS $file)
			{
				echo ' /* ' . $file . ' */' . "\n";
				echo $scripts[$file];
			}
		}
		
		public static function script_tag()
		{
			echo '<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>' . "\n";
			echo '<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.10/jquery-ui.min.js"></script>' . "\n";
			echo '<script type="text/javascript" src="/scripts.js"></script>' . "\n";
		}
		
	}
	
	hook::register('html_head', array('class' => 'page_js', 'method' => 'script_tag'));


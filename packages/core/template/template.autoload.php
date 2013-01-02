<?php
	function template($filename, $params = array())
	{
		$caller = package::get_by_backtrace(debug_backtrace());
		$dir = $caller->path;

		$template = null;
		if(file_exists($dir . $filename . '.tpl.php'))
		{
			$template = $dir . $filename . '.tpl.php';
		}
		elseif(file_exists($dir . 'templates/' . $filename . '.tpl.php'))
		{
			$template = $dir . 'templates/' . $filename . '.tpl.php';
		}
		else
		{
			throw new Exception('Template ' . $filename . ' not found');
		}

		foreach($params as $key => $value)
		{
			if($key != 'template_handle')
			{
				$$key = $value;
			}
		}
		ob_start();
		include($template);
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}


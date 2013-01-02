<?php

	function debug_error($code, $string, $file = null, $line = null, $context = null)
	{
		$msg = '---' . "\n";
		$msg .= date('Y-m-d H:i:s') . ' ' . (isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : null) . "\n";
		$msg .= $file . ' #' . $line . "\n";
		$msg .= $code . ': ' . $string;
		$msg .= "\n\n";

		file_put_contents(PATH_LOG . 'error-' . date('Y-m-d') . '.log', $msg, FILE_APPEND);
		return true;
	}

	set_error_handler('debug_error');

	class debug
	{
		static $messages = array();
		
		public static function log($msg, $options = array('category' => 'general'))
		{
			$trace = debug_backtrace();
			$msg = date('H:i:s') . ' ' . $trace[0]['file'] . '#' . $trace[0]['line'] . "\n" . print_r($msg, true) . "\n\n\n";

			if(!file_exists(PATH_LOG . 'debug/'))
			{
				mkdir(PATH_LOG . 'debug/');
			}

			if(!file_exists(PATH_LOG . 'debug/' . $options['category']))
			{
				mkdir(PATH_LOG . 'debug/' . $options['category']);
			}

			file_put_contents(PATH_LOG . 'debug/' . $options['category'] . '/' . date('Y-m-d') . '.log', $msg, FILE_APPEND);
			self::$messages[] = $msg;
		}
		
		public static function render()
		{
			echo template('list', array('messages' => self::$messages));
		}
	}

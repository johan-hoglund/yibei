<?php

	class date_tools
	{
		public static function duration_readable($duration)
		{
			$days = floor($duration/86400);
			$hrs = floor(($duration - $days * 86400) / 3600);
			$min = floor(($duration - $days * 86400 - $hrs * 3600) / 60);
			$s = $duration - $days * 86400 - $hrs * 3600 - $min * 60;
			
			$return = ($days > 0) ? $days . ' d ' : '';
			$return .= ($days > 0 || $hrs > 0) ? $hrs . ' h ' : '';
			$return .= ($days > 0 || $hrs > 0 || $min > 0) ? $min . ' m ' : '';
			$return .= ($s > 0) ? $s . ' s ' : '';

			return $return;
		}

		public static function date_readable($timestamp)
		{
			return date('Y-m-d H:i:s', $timestamp);
		}
		
		public static function date_relative($timestamp)
		{
			if($timestamp > strtotime(date('Y-m-d 00:00:00')))
			{
				return 'Today ' . date('H:i', $timestamp);
			}
			if($timestamp > strtotime(date('Y-m-d 00:00:00')) - 86400)
			{
				return 'Yesterday ' . date('H:i', $timestamp);
			}
		}
	}

?>
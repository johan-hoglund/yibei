<?php
	
	class parsing_tools
	{
		public static function preint_r($data)
		{
			$out = '<pre>' . "\n";
			$out .= print_r($data, true);
			$out .= '</pre>' . "\n";
			
			return $out;
		}
		
		public static function cute_number($num)
		{
			return(number_format  ($num, 3, ',', ' '));
		}
		
		public static function handle($string)
		{
//			This should be moved into cacafony.conf or somewhere else more fitting. // Valentin
			$locale = setlocale(LC_ALL, NULL);
			setlocale(LC_ALL, 'en_GB.UTF-8');
			
			$string = iconv("utf-8", "us-ascii//TRANSLIT", $string);
			$string = strtolower($string);
			$string = str_replace(' ', '-', $string);
			$string = preg_replace('/[^-a-z0-9]/', '', $string);
			$string = preg_replace('#[-]{2,}#', '-', $string);
			
			setlocale(LC_ALL, $locale);
			
			return($string);
		}
		
		public static function domain_from_url($url)
		{
			preg_match('@^(?:https?://)?([^/]+)@i', $url, $matches);
			$host = $matches[1];
			return $host;
		}
		
		public static function handle_by_table ($string, $table, $col = 'handle')
		{
			$norm_name = self::handle($string);
			$query = sprintf(
				'SELECT %1$s,(CONVERT(SUBSTR(%1$s,1+LENGTH(\'%3$s\')),SIGNED INTEGER)) AS sortfield'
					. ' FROM %2$s'
					. ' WHERE %1$s RLIKE \'^%3$s(-[0-9]+)?$\''
					. ' ORDER BY sortfield'
					. ' LIMIT 1'
				, $col
				, $table
				, $norm_name
			);
			
			$result = mysql_query($query);
			
			if(($rows = mysql_num_rows($result)) > 0)
			{
				$return = ($norm_name . ((mysql_fetch_object($result)->sortfield)-1));
			} else {
				$return = $norm_name;
			}
			
			return($return);
		}
		
		
		public static function clean($rules, $data, $options = array())
		{
			$out = array();
			foreach($rules AS $var => $rule)
			{			
				$data[$var] = ($rule['array'] && is_array($data[$var])) ? $data[$var] : array($data[$var]);


				$out[$var] = $data[$var];
			}
			return $out;
		}
		
		public static function latex_escape($phrase)
		{
			$yummy = array();
			$healthy = array('\\', '&', '/', '{', '}');
			foreach($healthy AS $itm)
			{
				$yummy[] = '\\' . $itm;
			}
			
			return str_replace($healthy, $yummy, $phrase);
		}
	}
?>

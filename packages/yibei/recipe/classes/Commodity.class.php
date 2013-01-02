<?php
	class Commodity extends fetcher
	{
		public static $fields = array('singular', 'plural');
		protected static $db_name = 'Commodities';

		public static function get_by_name($name)
		{
			$name = new Str($name);

			$q = 'SELECT id FROM Commodities WHERE singular LIKE "' . $name->mysql_safe() . '" OR plural LIKE "' . $name->mysql_safe() . '" LIMIT 1';
			$res = mysql_query($q);
			if($data = mysql_fetch_assoc($res))
			{
				return self::fetch_single(array('id' => $data['id']));
			}
			$commodity = new Commodity();
			$commodity->set('singular', $name);
			$commodity->save();
			return $commodity;
		}
	}

<?php

	class Ingredient extends fetcher
	{
		public static $fields = array('commodity_id', 'amount', 'unit');
		protected static $db_name = 'Ingredients';

		public function get_commodity()
		{
			return Commodity::fetch_single(array('id' => $this->commodity_id));
		}
		
		public function get_readable_amount()
		{
			return round($this->amount, ceil(0-log10($this->amount)) + 2);
		}

		public static function all_units()
		{
			return array('msk', 'tsk', 'cl', 'dl', 'l', 'st', 'g', 'kg', 'klyftor', 'knippen', 'buntar');
		}

		public static function units_dropdown($name = null)
		{
			$drop = new html_dropdown($name);
			foreach(self::all_units() AS $unit)
			{
				$drop->add($unit);
			}
			return $drop;
		}

		public function unit_dropdown($name = null)
		{
			$drop = new html_dropdown($name);
			foreach(self::all_units() AS $unit)
			{
				$drop->add($unit);
			}
			$drop->set_selected($this->unit);
			return $drop;
		}
	}



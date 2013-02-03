<?php
	class IngredientListMember extends fetcher
	{
		public static $fields = array('list_id', 'commodity_id', 'amount', 'unit');
		protected static $db_name = 'IngredientListMembers';

		public function get_commodity()
		{
			return Commodity::fetch_single(array('id' => $this->commodity_id));
		}

		public function get_readable_amount()
		{
			return round($this->amount);
		}
	}

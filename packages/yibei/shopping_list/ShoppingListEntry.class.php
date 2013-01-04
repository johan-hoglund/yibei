<?php
	class ShoppingListEntry extends fetcher
	{
		public static $fields = array('user_id', 'commodity_id', 'amount', 'unit', 'added_at', 'status');
		protected static $db_name = 'ShoppingListEntries';

		public function db_encode_added_at()
		{
			if(!isset($this->added_at))
			{
				$this->added_at = new DateTime();
			}
			return $this->added_at->format('Y-m-d H:i:s');
		}

		public function get_status()
		{
			if(!isset($this->status))
			{
				$this->status = 'pending';
			}

			return $this->status;
		}

		public function db_encode_status()
		{
			return $this->get_status();
		}

		public function db_decode_added_at($data)
		{
			$this->added_at = new DateTime($data);
		}

		public function get_commodity()
		{
			return Commodity::fetch_single(array('id' => $this->commodity_id));
		}
	}

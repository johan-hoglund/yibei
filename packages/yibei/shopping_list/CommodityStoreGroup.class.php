<?php
	class CommodityStoreGroup extends fetcher
	{
		public static $fields = array('title', 'order');
		protected static $db_name = 'CommodityStoreGroups';

		public static function fetch($options = array())
		{
			$options['order-by'] = isset($options['order-by']) ? $options['order-by'] : array('title' => 'asc');
			return parent::fetch($options);
		}

	}

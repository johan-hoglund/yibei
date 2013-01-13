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

		public function fetch_by_commodity(Commodity $c, $options = array())
		{
			$options['min_total_votes'] = isset($options['min_total_votes']) ? $options['min_total_votes'] : 1;
			$options['min_certainity'] = isset($options['min_certainity']) ? $options['min_certainity'] : 0.75;

			$q = 'SELECT group_id FROM AggregatedCommodityStoreGroupMembers WHERE commodity_id = "' . $c->get('id') . '"';
			$q .= ' AND certainity >= "' . $options['min_certainity'] . '" AND total_votes >= "' . $options['min_total_votes'] . '"';

			debug::log($q);

			if(!$r = mysql_query($q))
			{
				throw new Exception();
			}

			if(mysql_num_rows($r) == 1)
			{
				$d = mysql_fetch_assoc($r);
				
				debug::log($d);
				
				$group = CommodityStoreGroup::fetch_single(array('id' => $d['group_id']));
				debug::log($group);
				return $group;
			}

			return false;
		}

	}

<?php
	class ShoppingList 
	{
		private $user;

		public function __construct(User $user)
		{
			$this->user = $user;
		}

		public function set_user(User $user)
		{
			$this->user = $user;
		}
		
		public function count()
		{
			return count(ShoppingListEntry::fetch(array('user_id' => $this->user->get('id'))));
		}

		public function get_groups($options = array())
		{
			return CommodityStoreGroup::fetch();
		}

		public function add_commodity(Commodity $commodity)
		{
			$sle = new ShoppingListEntry();
			$sle->set('commodity_id', $commodity->get('id'));
			$sle->set('user', $this->user);
			$sle->save();
		}

		public function items_by_group(CommodityStoreGroup $group = null)
		{
			$entry_ids = array();
			
			if($group instanceof CommodityStoreGroup)
			{
				// Following logic should be possible to merge in one sql query

				// Select all the entries which the user has categorized:
				$q = 'SELECT sle.id AS sle_id FROM ShoppingListEntries AS sle, CommodityStoreGroupMembers AS csgm';
				$q .= ' WHERE csgm.user_id = sle.user_id = "' . $this->user->get('id') . '" AND csgm.commodity_id = sle.commodity_id';
				$q .= ' AND csgm.group_id = "' . $group->get('id') . '"';

				if(!$r = mysql_query($q))
				{
					throw new Exception('SQL Query failed: ' . $q);
				}
				while($d = mysql_fetch_assoc($r))
				{
					$entry_ids[] = $d['sle_id'];
				}

				// Select all entries which the user hasn't categorized, but for which we are sure about category relationship
				$q = 'SELECT sle.id AS sle_id FROM ShoppingListEntries AS sle, AggregatedCommodityStoreGroupMembers as acsgm';
				$q .= ' LEFT OUTER JOIN CommodityStoreGroupMembers AS csgm ON csgm.commodity_id = acsgm.commodity_id AND csgm.user_id = "' . $this->user->get('id') . '"';
				$q .= ' WHERE sle.user_id = "' . $this->user->get('id') . '" AND csgm.group_id IS NULL AND acsgm.certainity > 0.5 AND acsgm.group_id = "' . $group->get('id') . '"';

				
				if(!$r = mysql_query($q))
				{
					throw new Exception('SQL Query failed: ' . $q);
				}
				while($d = mysql_fetch_assoc($r))
				{
					$entry_ids[] = $d['sle_id'];
				}
			}
			if(!($group instanceof CommodityStoreGroup) || $group->get('id') == YIBEI_COMMODITY_STORE_GROUP_OTHERS)
			{
				// Bug, the query fetches entries in the ACSGM table with certainity < 0.5, even if there is one of the same commodity_id with certainity > 0.5
				$q = 'SELECT sle.id, sle.*, csgm.*, acsgm.*';
				$q .= ' FROM ShoppingListEntries AS sle';
				$q .= ' LEFT JOIN CommodityStoreGroupMembers AS csgm ON sle.commodity_id = csgm.commodity_id';
				$q .= ' LEFT JOIN AggregatedCommodityStoreGroupMembers AS acsgm ON acsgm.commodity_id = sle.commodity_id';
				$q .= ' WHERE (csgm.commodity_id IS NULL) AND (acsgm.group_id IS NULL OR acsgm.certainity < 0.5) AND sle.user_id = "' . $this->user->get('id') . '"';

				debug::log($q);

				if(!$r = mysql_query($q))
				{
					throw new Exception('SQL Query failed: ' . $q);
				}
				while($d = mysql_fetch_assoc($r))
				{
					$entry_ids[] = $d['id'];
				}
			}


			return ShoppingListEntry::fetch(array('id' => $entry_ids));
		}


	}

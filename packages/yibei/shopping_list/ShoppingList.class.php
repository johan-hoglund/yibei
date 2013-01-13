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
			$q = 'SELECT DISTINCT CSGM.group_id FROM CommodityStoreGroupMembers AS CSGM, ShoppingListEntries AS SLE';
			$q .= ' WHERE CSGM.commodity_id = SLE.commodity_id AND SLE.user_id = "' . $this->user->get('id') . '"';
			$q .= ' AND SLE.status = "pending"';

			if(!$r = mysql_query($q))
			{
				throw new Exception('SQL query failed');
			}
			
			$group_ids = array();
			while($d = mysql_fetch_assoc($r))
			{
				$group_ids[] = $d['group_id'];
			}
			if(!in_array(YIBEI_COMMODITY_STORE_GROUP_OTHERS, $group_ids))
			{
				 $group_ids[] = YIBEI_COMMODITY_STORE_GROUP_OTHERS;
			}

			return CommodityStoreGroup::fetch(array('id' => $group_ids));
		}

		public function add_commodity(Commodity $commodity)
		{
			$sle = new ShoppingListEntry();
			$sle->set('commodity_id', $commodity->get('id'));
			$sle->set('user_id', $this->user->get('id'));
			$sle->save();
		}

		public function items_by_group(CommodityStoreGroup $group = null)
		{
			$entry_ids = array();
			
			if($group instanceof CommodityStoreGroup)
			{
				$q = 'SELECT sle.id FROM ShoppingListEntries AS sle, CommodityStoreGroupMembers AS csgm';
				$q .= ' WHERE sle.commodity_id = csgm.commodity_id AND sle.user_id = "' . $this->user->get('id') . '"';
				$q .= 'AND csgm.group_id = "' . $group->get('id') . '"';
				
				if(!$r = mysql_query($q))
				{
					throw new Exception('SQL Query failed: ' . $q);
				}
				while($d = mysql_fetch_assoc($r))
				{
					$entry_ids[] = $d['id'];
				}
			}
			if(!($group instanceof CommodityStoreGroup) || $group->get('id') == YIBEI_COMMODITY_STORE_GROUP_OTHERS)
			{
				$q = 'SELECT sle.id FROM ShoppingListEntries AS sle';
				$q .= ' LEFT JOIN CommodityStoreGroupMembers AS csgm ON sle.commodity_id = csgm.commodity_id';
				$q .= ' WHERE (csgm.commodity_id IS NULL OR csgm.group_id IS NULL) AND sle.user_id = "' . $this->user->get('id') . '"';
				
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

<?php
	class ShoppingListAssignGroup implements page
	{
		public static function get_url_pattern()
		{
			return array('#^/shopping_list/assignGroup.json$#' => 15);
		}

		public function output($uri)
		{
			if(!$member = CommodityStoreGroupMember::fetch_single(array('user_id' => user::current()->get('id'), 'commodity_id' => $_GET['cid'])))
			{
				$member = new CommodityStoreGroupMember();
				$member->set('user_id', user::current()->get('id'));
				$member->set('commodity_id', $_GET['cid']);
			}

			$member->set('group_id', $_GET['gid']);

			$member->save();
		}
	}



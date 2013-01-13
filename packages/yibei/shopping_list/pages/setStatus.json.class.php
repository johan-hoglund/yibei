<?php
	class ShoppingListSetStatusJson implements page
	{
		public static function get_url_pattern()
		{
			return array('#^/shopping_list/setStatus.json$#' => 15);
		}

		public function output($uri)
		{
			if($entry = ShoppingListEntry::fetch_single(array('user_id' => user::current()->get('id'), 'commodity_id' => $_GET['cid'])))
			{
				$entry->set('status', $_GET['status']);
				$entry->save();

				debug::log($entry);
			}
			debug::log($_GET);
		}
	}



<?php
	class ShoppingListAddItemJson implements page
	{
		public static function get_url_pattern()
		{
			return array('#^/shopping_list/addItem.json$#' => 15);
		}

		public function output($uri)
		{
			debug::log('Got add item!');
			debug::log($_GET);

			$entry = new ShoppingListEntry();
			$entry->set('commodity_id', $_GET['cid']);
			$entry->set('amount', $_GET['amount']);
			$entry->set('unit', $_GET['unit']);
			$entry->set('user', user::current());

			$entry->save();
			

		}
	}



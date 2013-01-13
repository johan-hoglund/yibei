<?php
	
	class shopping_list_view extends yibei_page
	{
		public static function get_url_pattern()
		{
			return array('#^/inkopslista$#' => 10);
		}

		public function execute($uri)
		{
			$list = new ShoppingList();
			$list->set_user(User::current());
			
			if(isset($_POST) && $_POST['new_articles'])
			{
				foreach(explode("\n", $_POST['new_articles']) AS $string)
				{
					$commodity = Commodity::get_by_name($string);
					$list->add_commodity($commodity);
				}
			}


			$this->content = template('list', array('list' => $list, 'is_owner' => true));
		}
	}

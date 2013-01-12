<?php

	class commodity_edit extends yibei_page
	{
		public static function  get_url_pattern()
		{
			return array('#^/ingrediens/[a-zA-Z0-9-_]*/redigera$#' => 20);
		}
		
		public function execute($uri)
		{
			if(!preg_match('#^/ingrediens/([a-zA-Z0-9-_]*)/redigera$#', $uri, $matches))
			{
				throw new NotFoundException();
			}

			if(!$commodity = Commodity::fetch_single(array('handle' => $matches[1])))
			{
				if(!$commodity = Commodity::fetch_single(array('id' => $matches[1])))
				{
					debug::log(Commodity::fetch_single(array('id' => $matches[1])));
					debug::log($commodity);
					debug::log($matches);
					throw new NotFoundException();
				}
			}

			$this->main_content = template('edit_commodity', array('commodity' => $commodity));
		}
	}


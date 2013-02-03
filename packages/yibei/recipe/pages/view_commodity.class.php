<?php

	class commodity_view extends yibei_page
	{
		public static function  get_url_pattern()
		{
			return array('#^/ingrediens/[a-zA-Z0-9-_]*$#' => 20);
		}
		
		public function execute($uri)
		{
			if(!preg_match('#^/ingrediens/([a-zA-Z0-9-_]*)#', $uri, $matches))
			{
				throw new NotFoundException();
			}

			if(!$commodity = Commodity::fetch_single(array('handle' => $matches[1])))
			{
				if(!$commodity = Commodity::fetch_single(array('id' => $matches[1])))
				{
					throw new NotFoundException();
				}
			}

			if(!$commodity->is_orphan())
			{
				$this->redirect = $commodity->get_url();
			}

			if(isset($_POST) && isset($_POST['action']))
			{
				$commodity->get('main_imagecrop')->update_from_postdata($_POST['main_imagecrop']);
				$commodity->save();
			}

			$this->main_content = template('view_commodity', array('commodity' => $commodity));
		}
	}


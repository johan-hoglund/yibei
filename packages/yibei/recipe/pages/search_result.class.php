<?php

	class recipe_search extends yibei_page
	{
		public static function  get_url_pattern()
		{
			return array('#^/s/[a-zA-Z0-9-_]*$#' => 10);
		}
		
		public function execute($uri)
		{
			$title = substr($uri, 3);
			$title = ucfirst(str_replace('-', ' ', $title));

			$this->main_content .= '<h1>' . $title . '</h1>';
		
			$matches = Recipe::fetch(array('limit' => 4));
			$this->main_content .= Recipe::render_list($matches);

		}
	}


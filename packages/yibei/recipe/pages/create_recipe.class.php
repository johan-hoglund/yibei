<?php

	class recipe_create extends yibei_page
	{
		public static function  get_url_pattern()
		{
			return array('#^/recept/skapa$#' => 20);
		}
		
		public function execute($uri)
		{
			$this->main_content = Recipe::render_create_form();
		}
	}


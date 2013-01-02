<?php

	class start_page extends yibei_page
	{
		public static function  get_url_pattern()
		{
			return array('#^$#' => 10);
		}

		public function execute($uri)
		{
			$recipes = yibei_recipe::fetch();
			$this->heading = 'Yibeis recept';
			$this->main_content = yibei_recipe::render_list($recipes);
		}
	}


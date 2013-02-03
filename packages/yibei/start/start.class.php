<?php

	class start_page extends yibei_page
	{
		public static function  get_url_pattern()
		{
			return array('#^$#' => 10);
		}

		public function execute($uri)
		{
			$recipes = Recipe::fetch();
			$this->main_content .= '<h1 class="col_12">Yibeis receptsajt</h1>';
			$this->main_content .= Recipe::render_list($recipes);
		}
	}


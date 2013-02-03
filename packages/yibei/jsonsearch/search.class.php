<?php

	class json_search implements page
	{
		public static function  get_url_pattern()
		{
			return array('#^/json_search$#' => 10);
		}
		
		public function output($uri)
		{
			$recipes = yibei_recipe::fetch(array('solr_search' => '*' . $_GET['q'] . '*'));
			echo yibei_recipe::render_list($recipes);

			debug::log($_GET['q']);
		}
	}


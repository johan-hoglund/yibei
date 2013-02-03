<?php

	class recipe_push_to_solr extends yibei_page
	{
		public static function  get_url_pattern()
		{
			return array('#^/solr/reindex$#' => 10);
		}
		
		public function execute($uri)
		{
	
			foreach(yibei_recipe::fetch() AS $recipe)
			{
				$recipe->toSolr();
			}
		}
	}


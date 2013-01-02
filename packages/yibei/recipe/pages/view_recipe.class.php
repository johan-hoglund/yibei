<?php

	class recipe_view extends yibei_page
	{
		public static function  get_url_pattern()
		{
			return array('#^/recept/[a-zA-Z0-9-_]*$#' => 10);
		}
		
		public function set_top_bg($bg)
		{
			if($bg instanceof imagecrop)
			{
				$this->top_bg = $bg;
			}
			else
			{
				$this->top_bg->update_from_postdata($bg);
			}
		}

		public function execute($uri)
		{
			if(!preg_match('#^/recept/([a-zA-Z0-9-_]*)#', $uri, $matches))
			{
				throw new NotFoundException();
			}

			if(!$recipe = yibei_recipe::fetch_single(array('handle' => $matches[1])))
			{
				throw new NotFoundException();
			}
			
			$this->main_content = $recipe->render_instructions();

		}
	}


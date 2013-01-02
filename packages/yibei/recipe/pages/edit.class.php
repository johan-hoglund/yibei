<?php

	class recipe_edit extends yibei_page
	{
		public static function  get_url_pattern()
		{
			return array('#^/recept/[a-zA-Z0-9-_]*/redigera$#' => 10);
		}

		public function execute($uri)
		{
			if(!preg_match('#^/recept/([a-zA-Z0-9-_]*)/redigera#', $uri, $matches))
			{
				throw new NotFoundException();
			}

			if(!$recipe = yibei_recipe::fetch_single(array('handle' => $matches[1])))
			{
				throw new NotFoundException();
			}

			if(isset($_POST['title']))
			{
				foreach(yibei_recipe::$fields AS $fld)
				{
					if(isset($_POST[$fld]))
					{
						$recipe->set($fld, $_POST[$fld]);
					}
				}
				$recipe->save();
			}
			
			$this->heading = 'Redigerar ' . $recipe->get('title');
			$this->main_content = $recipe->render_edit_form();

		}
	}


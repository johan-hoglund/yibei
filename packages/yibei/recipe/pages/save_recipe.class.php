<?php
	class create_recipe extends yibei_page
	{
		public static function  get_url_pattern()
		{
			return array('#^/recept/spara$#' => 15);
		}
		
		public function execute($uri)
		{
			if(isset($_POST['parent_recipe']))
			{
				if(!$parent = Recipe::fetch_single(array('id' => $_POST['parent_recipe'])))
				{
					throw new NotFoundException('The source recipe does not exist');
				}
				$recipe = clone $parent;
	
				if(isset($_POST['edit_mode']) && $_POST['edit_mode'] == 'vary')
				{
					$recipe->set('parent_relation', 'variation');
				}
				else
				{
					$recipe->set('parent_relation', 'correction');
				}
			}
			else
			{
				$recipe = new Recipe();
			}

			if(!isset($_POST))
			{
				throw new Exception('Tried to create new recipe without postdata');
			}

			$recipe->set_user(User::current());
			$recipe->data_from_post($_POST);
			$recipe->save();

			$this->redirect = $recipe->get('url');
		}
	}

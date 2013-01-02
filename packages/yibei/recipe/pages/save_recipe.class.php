<?php
	$script_count = 1;
	class create_recipe extends yibei_page
	{
		public static function  get_url_pattern()
		{
			return array('#^/recept/spara$#' => 15);
		}
		
		public function execute($uri)
		{
			global $script_count;

			debug::log('Script count: ' . $script_count);
			$script_count++;

			if(isset($_POST['parent_recipe']))
			{
				if(!$parent = yibei_recipe::fetch_single(array('id' => $_POST['parent_recipe'])))
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
				$recipe = new yibei_recipe();
			}

			$recipe->data_from_post($_POST);
			$recipe->save();
		}
	}

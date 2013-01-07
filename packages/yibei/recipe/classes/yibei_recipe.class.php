<?php
	class yibei_recipe extends fetcher
	{
		public static $fields = array('handle', 'title', 'top_bg', 'primary', 'user_id');
		public static $db_name = 'Recipies';

		public function __clone()
		{
			unset($this->id);
		}

		public function save()
		{
			mysql_query('UPDATE ' . self::$db_name . ' SET `primary` = NULL WHERE handle LIKE "' . $this->db_encode_handle() . '"');
			$this->primary = 1;
			parent::save();
		}

		public static function fetch($options = array())
		{
			if(!isset($options['allow_nonprimary']) && !isset($options['id']))
			{
				$options['primary'] = 1;
			}

			return parent::fetch($options);
		}

		public function db_encode_user_id()
		{
			return $this->user->get('id');
		}

		public function db_decode_user_id($id)
		{
			$this->user = User::lazy_from_id($id);
		}

		public function set_user(User $user)
		{
			$this->user = $user;
		}

		public function db_decode_top_bg($data)
		{
			$this->top_bg = unserialize($data);
		}

		public function db_encode_top_bg()
		{
			return serialize($this->get('top_bg'));
		}

		public function db_encode_handle()
		{
			if(!isset($this->handle) || strlen($this->handle) == 0)
			{
				$this->handle = parsing_tools::handle_by_table($this->title, self::$db_name);
			}
			return $this->handle;
		}

		public function get_title()
		{
			return $this->title;
		}

		public function get_top_bg()
		{
			if(isset($this->top_bg) && $this->top_bg instanceof imagecrop && $this->top_bg->exists())
			{
				return $this->top_bg;
			}
			return false;
		}

		public function get_preparation_steps()
		{
			$steps = array();
			foreach(RecipePreparationStep::fetch(array('recipe_id' => $this->id, 'order-by' => array('order' => 'asc'), 'debug' => true)) AS $rps)
			{
				if(!$steps[] = PreparationStep::fetch_single(array('id' => $rps->get('step_id'))))
				{
					throw new Exception('Preparation step #' . $rps->get('step_id') . ' not found');
				}
			}

			return $steps;
		}

		public function get_Ingredients()
		{
			$ingredients = array();
			foreach(RecipeIngredient::fetch(array('recipe_id' => $this->id)) AS $entry)
			{
				$ingredients[] = Ingredient::fetch_single(array('id' => $entry->get('ingredient_id')));
			}
			return $ingredients;
		}
		
		public function render_instructions()
		{
			return template('instructions', array('instructions' => $this->instructions, 'recipe' => $this));
		}

		public function render_create_form()
		{
			return template('instructions');
		}

		public function render_edit_form()
		{
			return template('edit_form', array('recipe' => $this));
		}

		public static function render_list($recipes = array(), $options = array())
		{
			$tpl = array();
			$tpl['recipes'] = $recipes;
			$tpl['mode'] = isset($options['mode']) ? $options['mode'] : 'standard';
			return template('list_recipes', $tpl);
		}

		public function get_url()
		{
			return '/recept/' . $this->handle;
		}

		public function data_from_post($p)
		{
			if(isset($p['title']))
			{
				$this->title = $p['title'];
			}
			if(!isset($this->id) || $this->id == 0)
			{
				$this->save();
			}

			if(isset($p['bg_handle']) && strlen($p['bg_handle']) > 0)
			{
				$ic = new imagecrop();
				foreach(array('handle', 'x1', 'x2', 'y1', 'y2') AS $key)
				{
					$ic->set($key, $p['bg_' . $key]);
				}
			}
			$this->set('top_bg', $ic);

			foreach($this->get('preparation_steps') AS $step)
			{
				$step->delete();
			}

			foreach($this->get('ingredients') AS $ingredient)
			{
				$ingredient->delete();
			}


			for($i = 0; isset($p['preparation_steps'][$i]); $i++)
			{
				if(strlen($p['preparation_steps'][$i]) > 0)
				{
					if(!$step = PreparationStep::fetch_single(array('text' => $p['preparation_steps'][$i])))
					{
						$step = new PreparationStep();
						$step->set('text', new Str($p['preparation_steps'][$i]));
						$step->save();
					}

					$recipe_step = new RecipePreparationStep();
					$recipe_step->set('recipe_id', $this->id);
					$recipe_step->set('step_id', $step->get('id'));
					$recipe_step->set('order', $i);
					$recipe_step->save();
				}
			}

			for($i = 0; isset($p['commodities'][$i]); $i++)
			{
				if(strlen($p['commodities'][$i]) > 0)
				{
					$commodity = Commodity::get_by_name($p['commodities'][$i]);

					if(!$ingredient = Ingredient::fetch_single(array('amount' => $p['amounts'][$i], 'unit' => $p['units'][$i], 'commodity_id' => $commodity->get('id'))))
					{
						$ingredient = new Ingredient();
						$ingredient->set('amount', $p['amounts'][$i]);
						$ingredient->set('unit', $p['units'][$i]);
						$ingredient->set('commodity_id', $commodity->get('id'));
						$ingredient->save();
					}

					$ri = new RecipeIngredient();
					$ri->set('recipe_id', $this->get('id'));
					$ri->set('ingredient_id', $ingredient->get('id'));
					$ri->save();
				}
			}
		}
	}

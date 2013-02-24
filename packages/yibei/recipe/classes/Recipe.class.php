<?php
	class Recipe extends fetcher
	{
		public static $fields = array('handle', 'title', 'top_bg', 'primary', 'user_id', 'description');
		public static $db_name = 'Recipes';

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

		public function ingredientLists()
		{
			return RecipeIngredientList::fetch(array('recipe_id' => $this->id));
		}

		public function toSolr()
		{
			$ch = curl_init();

			$fields = array();
			$fields['title'] = $this->title;
			$fields['id'] = $this->id;
			$fields['instructions'] = array();
			foreach($this->get('preparation_steps') AS $step)
			{
				$fields['instructions'][] = $step->get('text')->html_safe();
			}

			$fields['ingredients'] = array();
			foreach($this->get('Ingredients') AS $ingredient)
			{
				$fields['ingredients'][] = $ingredient->get('commodity')->get('singular');
				$fields['ingredients'][] = $ingredient->get('commodity')->get('plural');
			}

			$q = array();
			$q[] = $fields;

			$json = json_encode($q);

			debug::log($json);

			curl_setopt($ch, CURLOPT_URL, 'http://localhost:8983/solr/update/json?commit=true&wt=json');
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
			curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			$result = curl_exec($ch);

			debug::log($result);
		}

		public static function fetch($options = array())
		{
			if(!isset($options['allow_nonprimary']) && !isset($options['id']))
			{
				$options['primary'] = 1;
			}
			
			if(isset($options['solr_search']))
			{
				$solrJson = file_get_contents('http://localhost:8983/solr/collection1/select/?&q=*' . $options['solr_search'] . '*&fl=id&wt=json');
				$solrResult = json_decode($solrJson);
				if($solrResult->response->numFound > 0)
				{
					$options['id'] = isset($options['id']) ? $options['id'] : array();
					$options['id'] = is_array($options['id']) ? $options['id'] : array($options['id']);
					foreach($solrResult->response->docs AS $doc)
					{
						$options['id'][] = $doc->id;
					}
				}
				else
				{
					return array();
				}
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

		public function distinct_commodities($limit = 10)
		{
			$commodities = array();
			foreach(RecipeIngredientList::fetch(array('recipe_id' => $this->id)) AS $list)
			{
				$inner_list = $list->get_ingredient_list();
				debug::log(print_r($inner_list, true));
				foreach($inner_list->members() AS $member)
				{
					$commodities[] = $member->get_commodity();
				}
			}

			return $commodities;
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
			if(isset($options['columns']))
			{
				$tpl['columns'] = $options['columns'];
				$tpl['fixed'] = true;
			}
			return template('list_recipes', $tpl);
		}

		public function get_url()
		{
			return '/recept/' . $this->handle;
		}

		public function data_from_post($p)
		{
			debug::log($p);
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

			debug::log($p);
			$i = 0;
			foreach($p['RecipeIngredientLists'] AS $list)
			{
				$ilist = new IngredientList();
				$ilist->save();

				for($j = 0; isset($list['commodities'][$j]) && strlen($list['commodities'][$j]) > 0; $j++)
				{
					$listmember = new IngredientListMember();
					$listmember->set('list_id', $ilist->get('id'));
					$listmember->set('commodity_id', Commodity::get_by_name($list['commodities'][$j])->get('id'));
					$listmember->set('amount', $list['amounts'][$j]);
					$listmember->set('unit', $list['units'][$j]);
					$listmember->save();
				}

				$rlist = new RecipeIngredientList();
				$rlist->set('recipe_id', $this->id);
				$rlist->set('list_id', $ilist->get('id'));
				$rlist->set('order', $i);
				$rlist->set('label', $list['label']);
				$rlist->save();

				$i++;
			}

			$this->description = $p['description'];
		}
	}

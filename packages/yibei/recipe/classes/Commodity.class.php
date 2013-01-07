<?php
	class Commodity extends fetcher
	{
		public static $fields = array('singular', 'plural', 'handle');
		protected static $db_name = 'Commodities';

		public function db_encode_handle()
		{
			if(!isset($this->handle) || strlen($this->handle) == 0)
			{
				if(isset($this->singular) && strlen($this->singular) > 0)
				{
					$this->handle = parsing_tools::handle_by_table($this->singular, self::$db_name);
				}
				elseif(isset($this->plural) && strlen($this->plural) > 0)
				{
					$this->handle = parsing_tools::handle_by_table($this->plural, self::$db_name);
				}
				else
				{
					throw new Exception('Tried to db encode handle from commodity without singular or plural form');
				}
			}
			return $this->handle;
		}

		public function get_associated_recipes($options = array())
		{
			$options['limit'] = isset($options['limit']) ? $options['limit'] : 10;
	
			// Horrible logic must be done in SQL. This is in effect joining done in php :(
			$q = 'SELECT r.id 
				FROM Recipies AS r, Ingredients AS i, RecipeIngredients AS ri
				WHERE r.id = ri.recipe_id
				AND ri.ingredient_id = i.id
				AND i.commodity_id = "' . $this->id . '"
				LIMIT 0 , 30';
			$r = mysql_query($q) or die(mysql_error());
			$options['id'] = array();
			while($d = mysql_fetch_assoc($r))
			{
				$options['id'][] = $d['id'];
			}
		
			debug::log($options);

			return yibei_recipe::fetch($options);
		}

		public function get_handle()
		{
			if(isset($this->handle) && strlen($this->handle))
			{
				return $this->handle;
			}
			return $this->id;
		}

		public static function get_by_name($name)
		{
			$name = new Str(trim($name));

			$q = 'SELECT id FROM Commodities WHERE singular LIKE "' . $name->mysql_safe() . '" OR plural LIKE "' . $name->mysql_safe() . '" LIMIT 1';
			$res = mysql_query($q);
			debug::log($q);
			if($data = mysql_fetch_assoc($res))
			{
				debug::log('Found!');
				return self::fetch_single(array('id' => $data['id']));
			}
			$commodity = new Commodity();
			$commodity->set('singular', $name);
			$commodity->save();
			return $commodity;
		}

		public function get_url()
		{
			return '/ingrediens/' . $this->get_handle();
		}
	}

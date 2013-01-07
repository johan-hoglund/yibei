<?php

	class setget
	{	
		public function set($var, $value)
		{
			$function = 'set_' . $var;
			if(is_callable(array($this, $function)))
			{
				$this->$function($value);
			}
			else
			{
				$this->$var = $value;
			}
		}

		public function get($var)
		{
			$function = 'get_' . $var;
			if(is_callable(array($this, $function)))
			{
				return $this->$function();
			}
			else
			{
				return isset($this->$var) ? $this->$var : false;
			}
		}
	}


	// Keyword static allows for lookups in inheriting classes, self:: will always
	// point to the class where the property was defined. Google for "late static binding"

	abstract class fetcher extends setget
	{
		private $is_lazy = false;
		protected static $db_name;
		public static $fields = array();

		public function get($var)
		{
			$this->getreal();
			return parent::get($var);
		}

		public static function fetch($options = array())
		{
			$cleaner = new cleaner($options);
			$cleaner->rule('id', 'array', true);

			$query = 'SELECT ' . static::$db_name . '.* FROM ' . static::$db_name . ' WHERE 1';
			foreach(array_merge(array('id'), static::$fields) AS $field)
			{
				if(array_key_exists($field, $options))
				{
					$cleaner->rule($field, 'array', true);
					$clean = $cleaner->get($field);

					if(!is_array($clean) || count($clean) == 0)
					{
						return array(); // Empty list of exclusive field values was provided
					}
					$query .= ' AND `' . $field . '` IN("' . implode($clean, '", "') . '")';
				}
				if(array_key_exists('freetext_' . $field, $options))
				{
					$query .= ' AND `' . $field . '` LIKE "%' . $cleaner->get('freetext_' . $field) . '%"';
				}
				if(array_key_exists('like_' . $field, $options))
				{
					$query .= ' AND `' . $field . '` LIKE "' . $cleaner->get('like_' . $field) . '"';
				}
				if(array_key_exists('min_' . $field, $options))
				{
					$query .= ' AND `' . $field . '` >= "' . $cleaner->get('min_' . $field) . '"';
				}
				if(array_key_exists('max_' . $field, $options))
				{
					$query .= ' AND `' . $field . '` <= "' . $cleaner->get('max_' . $field) . '"';
				}
			}
			$query .= isset($options['extra_where']) ? ' ' . $options['extra_where'] : null;

			if(isset($options['order-by']))
			{
				$pieces = array();
				foreach($options['order-by'] AS $fld => $dir)
				{
					$pieces[] = '`' . $fld . '` ' . $dir;
				}
				$query .= ' ORDER BY ' . implode(', ', $pieces);
			}

			if(isset($options['limit']) && $options['limit'] > 0)
			{
				$options['offset'] = (isset($options['offset']) && $options['offset'] > 0) ? $options['offset'] : 0;
				$query .= ' LIMIT ' . $options['offset'] . ',' . $options['limit'];
			}
	
			$objs = array();
			foreach(mysqls(array('query' => $query)) AS $row)
			{
				if(is_callable('static::resolve_target_class'))
				{
					$class = static::resolve_target_class($row);
					$obj = new $class();
				}
				else
				{
					$obj = new static();
				}
				$obj->set('id', $row['id']);
				foreach(static::$fields AS $field)
				{
					$function = 'db_decode_' . $field;
					if((is_callable(array($obj, $function))))
					{
						$obj->$function($row[$field]);
					}
					else
					{
						$obj->set($field, $row[$field]);
					}
				}
				
				$objs[$row['id']] = $obj;
			}
			return $objs;
		}

		public static function lazy_from_id($id)
		{
			$obj = new static();
			$obj->set('id', $id);
			$obj->set('lazy', true);
			return $obj;
		}

		public function getreal()
		{
			if($this->lazy)
			{
				$this->lazy = false;
				$real = static::fetch_single(array('id' => $this->id));
				foreach(get_object_vars($real) AS $key => $val)
				{
					$this->$key = $val;
				}
			}
		}
		
		public static function fetch_single($options = array())
		{
			$options['limit'] = 1;
			$results = static::fetch($options);
			if(count($results) > 0)
			{
				return array_pop($results);
			}
			return false;
		}
		
		public function save()
		{
			$this->getreal();
			$data = array();
			foreach(static::$fields AS $fld)
			{
				$data[$fld] = $this->$fld;
			}
			$cleaner = new cleaner($data);
		
		
			if(isset($this->id))
			{
				$query = 'UPDATE ' . static::$db_name . ' SET';
			}
			else
			{
				if($this instanceof yibei_recipe)
				{
					debug::log('ID not set');
				}
				$query = 'INSERT INTO ' . static::$db_name . ' SET';
			}

			for($i = 0; $i < count(static::$fields); $i++)
			{
				$query .= ($i > 0) ? ', ' : ' ';
				$field = static::$fields[$i];
				$function = 'db_encode_' . $field;
				$data = (is_callable(array($this, $function))) ? $this->$function() : $this->$field;
				if($data === null || strlen($data) == 0)
				{
					$query .= '`' . $field . '` = NULL';
				}
				else
				{
					if(is_object($data) && !method_exists($data, '__toString'))
					{
						throw new Exception('Can not insert object of type ' . get_class($data) . ' as field ' . $field);
					}
					$query .= '`' . $field . '` = "' . mysql_real_escape_string($data) . '"';
				}
			}
			
			if(isset($this->id))
			{
				$query .= ' WHERE id = "' . $this->id . '"';
			}
		
			if(!mysql_query($query))
			{
				echo $query . '<br />';
				throw new Exception('Database error while saving: ' . mysql_error());
			}
			if(!isset($this->id) || $this->id == 0)
			{
				$this->id = mysql_insert_id();
			}

			return true;
		}
		
		public function delete()
		{
			$query = 'DELETE FROM `' . static::$db_name . '` WHERE id = "' . mysql_real_escape_string($this->id) . '" LIMIT 1';
			if(!mysql_query($query))
			{
				throw new Exception('Could not delete ' . var_dump($this)); 
			}
		}
	}

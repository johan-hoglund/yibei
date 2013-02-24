<?php
	class User extends fetcher
	{
		private static $current;
		public static $fields = array('displayname', 'fb_id', 'created_at', 'picture_url', 'create_method', 'class', 'persistent_token');
		protected static $db_name = 'Users';

		public function db_encode_created_at()
		{
			return $this->created_at->format('Y-m-d H:i:s');
		}

		public function db_decode_created_at($data)
		{
			$this->created_at = new datetime($data);
		}

		public function sign_out()
		{
			unset($_SESSION['user_id']);
		}

		public function render_navbar_entry()
		{
			return template('navbar_entry', array('user' => $this));
		}
	
		public function save()
		{
			if(!isset($this->created_at))
			{
				$this->created_at = new datetime();
			}
			parent::save();
		}

		public function render_avatar($size = 'normal')
		{
			return template('avatar', array('user' => $this, 'size' => $size));
		}

		public static function from_fb_id($id)
		{
			if($user = self::fetch_single(array('fb_id' => $id)))
			{
				return $user;
			}
			else
			{
				if($data = json_decode(file_get_contents('https://graph.facebook.com/' . $id . '?fields=id,name,picture.width(160)')))
				{
					$user = new User();
					$user->set('fb_id', $id);
					$user->set('displayname', $data->name);
					$user->set('picture_url', $data->picture->data->url);
					$user->save();
					
					return $user;
				}
			}
			throw new Exception('FB user not found');
		}

		protected function db_encode_persistent_token()
		{
			return $this->persistent_token();
		}

		private function persistent_token()
		{
			return sha1($this->id . 'This salt should be moved somewhere else :)');
		}

		public static function set_current(User $current)
		{
			if(!isset($current))
			{
				throw new Exception('Trying to set null as current user');
			}
			self::$current = $current;
			$_SESSION['user_id'] = $current->get('id');
		
			setcookie('yibei_persistent_token', $current->persistent_token(), time()+86400*365, '/', null, false, true);
		}

		public function facebook_connected()
		{
			return !$this->is_anonymous();
		}

		public function is_anonymous()
		{
			return $this->class == 'anonymous';
		}

		public function get_displayname()
		{
			if(!isset($this->displayname))
			{
				return 'Gäst';
			}
			return $this->displayname;
		}

		public function get_avatar_small_url()
		{
			return $this->picture_url;
		}

		public function small_profile($options = array())
		{
			$options['user'] = $this;
			return template('small_profile', $options);
		}

		public static function current()
		{
			if(self::$current instanceof User)
			{
				return self::$current;
			}
			if(isset($_SESSION['user_id']))
			{
				if(self::$current = self::fetch_single(array('id' => $_SESSION['user_id'])))
				{
					return self::$current;
				}
			}
			if(isset($_COOKIE['yibei_persistent_token']))
			{
				if(self::$current = self::fetch_single(array('persistent_token' => $_COOKIE['yibei_persistent_token'])))
				{
					return self::$current();
				}
			}

			$user = new User();
			$user->create_method = 'automatic';
			$user->class = 'anonymous';
			$user->save();
			User::set_current($user);
			return $user;
		}
	}

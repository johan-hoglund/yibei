<?php
	class user extends fetcher
	{
		protected $id;
		static $current;
		protected $signed_in = false;
		protected $shop_id = 0;
		protected $is_administrator = 0;
		protected $sms_code = 0;
		protected $phone_number = 0;
		
		protected static $db_name = 'users';
		public static $fields = array('email', 'password', 'salt', 'first_name', 'last_name', 'queue_time', 'shop_id', 'is_administrator', 'sms_code', 'sms_code_expiry', 'phone_number');
		
		public static function fetch($options = array())
		{
			$users = array();
			foreach(parent::fetch($options) AS $user)
			{
				if(!isset($options['auth']) || $user->auth($options['auth']))
				{
					$users[] = $user;
				}
			}

			return $users;
		}

		public function db_encode_sms_code_expiry()
		{
			if(isset($this->sms_code_expiry))
			{
				return $this->sms_code_expiry->format('c');
			}
			return null;
		}

		public function db_decode_sms_code_expiry($data)
		{
			$this->sms_code_expiry = new DateTime($data);
		}
	
		
		public function get_shop()
		{
			return cutit_shop::fetch_single(array('id' => $this->shop_id));
		}
		
		public function send_sms_code()
		{
			$code = null;
			$chars = '23456789ABCDEFGHJKLMNPQRSTUVWXYZ';
			for($i = 0; $i < 6; $i++)
			{
				$code .= $chars{rand(0, strlen($chars)-1)};
			}
			$expiry = new DateTime();
			$expiry->modify('+30 minutes');
			
			$this->sms_code = $code;
			$this->sms_code_expiry = $expiry;
			
			$this->save();
			
			$sms = new cutit_sms();
			$sms->set('text', 'Hej, du kan nu logga in med engångskoden ' . $code . ', koden är giltlig fram tills kl. ' . $expiry->format('H:i') . ' idag ' . $expiry->format('j/m'));
			$sms->set('destination', $this->phone_number);
			$sms->send();
		}
		
		public function sms_code_auth($code)
		{
			if(strlen($code) > 1)
			{
				$now = new DateTime();
				return (strtoupper($code) == $this->sms_code && $now < $this->sms_code_expiry);
			}
			return false;
		}
		
		static function current()
		{
			if(!is_object(self::$current))
			{
				self::$current = new user();
			}
			return self::$current;
		}
				
		static function set_current($user)
		{
			self::$current = $user;
		}

		public static function load_current()
		{
			if(isset($_SESSION['user']))
			{
				$user = unserialize($_SESSION['user']);
				self::$current = $user;
			}
		}
		
		static function save_current()
		{
			$_SESSION['user'] = serialize(self::$current);
		}
		
		static function status_bar()
		{
			$user = user::current();
			if($user->get('signed_in'))
			{
				echo template('status_bar', array('user' => $user));
			}
		}

		function auth($password)
		{
			return sha1($this->salt . $password) == $this->password;
		}
		
		function new_password($password)
		{
			$this->salt = rand(0, 9999999999);
			$this->password = sha1($this->salt . $password);
		}
		
		
		public function get_edit_url()
		{
			return '/user/edit/' . $this->id;
		}
	}
?>

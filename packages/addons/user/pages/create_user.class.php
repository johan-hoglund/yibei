<?php
	class page_create_user extends standard_page
	{		
		public static function get_url_pattern()
		{
			return array('bid' => 5, 'regexp' => '#^/user/create$#');
		}
		
		function execute($uri)
		{
			if(isset($_POST['action']) && $_POST['action'] == 'create')
			{
				$user = new user();
				foreach(array('email', 'first_name', 'last_name', 'is_traffic') AS $key)
				{
					$user->set($key, $_POST[$key]);
				}
				
				$user->new_password($_POST['desired_password']);
				
				if($_POST['desired_password'] == $_POST['password_verification'])
				{
					$user->save();
					notices_add('Användare skapad', 'Användaren är nu skapad. Tänk på att även skapa tillhörande salong och terminal', array('class' => 'success'));
				}
				else
				{
					notices_add('Lösenorden stämmer inte överrens', 'Det upprepade lösenordet stämmer inte överrens med det angivna, något användarkonto har därför inte skapats.', array('class' => 'error'));
				}				
			}
			
			$this->content .= template('create');
		}
	}


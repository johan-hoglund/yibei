<?php
	class page_user_edit extends standard_page
	{
		public static function get_url_pattern()
		{
			return array('bid' => 5, 'regexp' => '#^/user/edit/[0-9]*$#');
		}
		
		function execute($uri)
		{
			if(user::current()->get('is_traffic') != 1)
			{
				throw new AccessDeniedException('You have to be logged in with traffic privileges to edit users.');
			}
		
			preg_match('#^/user/edit/([0-9]*)$#', $uri, $matches);
			if(!$user = user::fetch_single(array('id' => $matches[1])))
			{
				throw new PageLoadException('User ' . $matches[1] . ' not found');
			}

			if(isset($_POST['action']) && $_POST['action'] == 'update') 
			{
				$user->set('email', $_POST['email']);
				$user->set('first_name', $_POST['first_name']);
				$user->set('last_name', $_POST['last_name']);
				$user->set('is_traffic', $_POST['is_traffic']);

				if(strlen($_POST['desired_password']) > 0)
				{
					if($_POST['desired_password'] == $_POST['password_verification'])
					{
						$user->new_password($_POST['desired_password']);
						notice::add(array('class' => 'success', 'heading' => 'Password updated'));
					}
					else
					{
						notice::add(array('class' => 'error', 'heading' => 'Password mismatch', 'text' => 'The password and the password verification field does not match'));						
					}
				}
				$user->save();
			}

			$template['user'] = $user;

			$this->content = template('edit', $template);
		}
	}
?>

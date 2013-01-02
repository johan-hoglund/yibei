<?php
	class page_control_panel extends standard_page
	{

		public static function get_url_pattern()
		{
			return array('bid' => 5, 'regexp' => '#^/user/control-panel$#');
		}

		function execute($uri)
		{
			if($_POST['action'] == 'update')
			{
				if(strlen($_POST['password']) > 0)
				{
					if(user::current()->auth($_POST['old_password']))
					{
						user::current()->new_password($_POST['desired_password']);
					
						$this->content .= 'Password update OK';
					}
					else
					{
							$this->content .= 'Password update failed';
					}
				}
				user::current()->set('queue_time', $_POST['queue_time']);
				user::current()->save();

				$shop = user::current()->get_shop();
				$shop->set('sms_sender', $_POST['sms_sender']);
				$shop->save();
			}
			
			
			$this->content .= template('control-panel', array('user' => user::current()));

		}
	}



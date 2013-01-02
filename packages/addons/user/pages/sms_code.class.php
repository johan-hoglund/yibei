<?php
	class user_sms_code extends standard_page
	{
		public static function get_url_pattern()
		{
			return array('bid' => 5, 'regexp' => '#^/user/sms_code$#');
		}
		
		function execute($uri)
		{
			if(isset($_POST['action']) && $_POST['action'] == 'request_code')
			{
				$user = user::fetch_single(array('phone_number' => $_POST['phone_number']));
				$user->send_sms_code();
				$this->content = template('sms_code_auth_form', array('phone_number' => $_POST['phone_number']));
			}
			elseif(isset($_POST['action']) && $_POST['action'] == 'auth')
			{
				$user = user::fetch_single(array('phone_number' => $_POST['phone_number']));
				if($user->sms_code_auth($_POST['sms_code']))
				{
					$user->set('signed_in', true);
					user::set_current($user);
					notices_add('Välkommen', 'Du har nu loggats in i CutIT');
					$this->redirect = '/';
				}
			}
			else
			{
				$this->content = template('sms_code_form');
			}
		}
	}
?>

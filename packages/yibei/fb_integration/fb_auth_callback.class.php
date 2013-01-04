<?php
	class fb_auth_callback implements page
	{	
		public static function get_url_pattern()
		{
			return array('#^/fb_auth_callback\.json$#' => 10);
		}
		
		public static function accepts($uri)
		{
			return true;
		}
		
		private static function base64_url_decode($str)
		{
			return base64_decode(strtr($str, '-_', '+/'));
		}

		public function output($uri)
		{
			list($encoded_sig, $payload) = explode('.', $_GET['signed'], 2);
			$sig = self::base64_url_decode($encoded_sig);
			$data = json_decode(self::base64_url_decode($payload), true);	

			if (strtoupper($data['algorithm']) !== 'HMAC-SHA256')
			{
				throw new Exception('Unsupported facebook sign algorithm');
			}
			
			$expected_sig = hash_hmac('sha256', $payload, FB_APP_SECRET, $raw = true);
			
			if ($sig !== $expected_sig)
			{
				throw new Exception('Facebook signature not valid');
			}

			try
			{
				$user = User::from_fb_id($data['user_id']);
			}
			catch(Exception $e)
			{
				// Do nothing
			}

			User::set_current($user);
		}		
	}


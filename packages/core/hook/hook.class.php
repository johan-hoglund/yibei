<?php
	class hook
	{
		static $hooks;
		
		public static function execute($handle, &$data = array())
		{
			if(isset(self::$hooks[$handle]) && is_array(self::$hooks[$handle]))
			{
				foreach(self::$hooks[$handle] AS $hook)
				{
					if($hook instanceof Closure)
					{
						$hook($data);
					}
					else
					{
						if(isset($hook['function']))
						{
							$hook['function']($data);
						}
					
						if(isset($hook['class']) && isset($hook['method']))
						{
							call_user_func(array($hook['class'], $hook['method']));
						}
					}
				}
			}
		}
		
		public static function register($handle, $hook)
		{
			self::$hooks[$handle][] = $hook;
		}
	}
?>

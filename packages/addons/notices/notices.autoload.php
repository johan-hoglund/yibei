<?php

	class notice
	{
		public static function add($options)
		{
			$options['heading'] = (isset($options['heading'])) ? $options['heading'] : null;
			$options['text'] = (isset($options['text'])) ? $options['text'] : null;

			notices_add($options['heading'], $options['text'], $options['class']);
		}
	}

	function render_notices()
	{
		if(is_array(user::current()->get('notices')))
		{
			foreach(user::current()->get('notices') AS $notice)
			{
				echo '<div class="notice ' . $notice['class'] . '"><h1>' . $notice['heading'] . '</h1><p>' . $notice['text'] . '</p></div>' . "\n";
			}
		}
		user::current()->notices = array();
	}
	
	function notices_add($heading, $text, $class = null)
	{
		user::current()->notices[] = array('heading' => $heading, 'text' => $text, 'class' => $class);
	}

	hook::register('page_head', array('function' => 'render_notices'));
?>

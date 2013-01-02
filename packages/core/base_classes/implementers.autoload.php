<?php
	function implementers($interface)
	{
		$classes = array();
		
		foreach(get_declared_classes() AS $class)
		{
			if(in_array($interface, class_implements($class)))
			{
				$classes[] = $class;
			}
		}
		
		return $classes;
	}

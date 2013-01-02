<?php
	function extenders($classname)
	{
		$classes = array();
		
		foreach(get_declared_classes() AS $class)
		{
			if(in_array($classname, class_parents($class)))
			{
				$classes[] = $class;
			}
		}
		
		return $classes;
	}

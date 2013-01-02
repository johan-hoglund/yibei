<?php
	class RecipeIngredient extends fetcher
	{
		public static $fields = array('recipe_id', 'ingredient_id');
		protected static $db_name = 'RecipeIngredients';
	}

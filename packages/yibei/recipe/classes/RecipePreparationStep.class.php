<?php
	class RecipePreparationStep extends fetcher
	{
		public static $fields = array('recipe_id', 'step_id', 'order');
		protected static $db_name = 'RecipePreparationSteps';
	}


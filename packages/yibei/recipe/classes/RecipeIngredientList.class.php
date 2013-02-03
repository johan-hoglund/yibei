<?php
	class RecipeIngredientList extends fetcher
	{
		public static $fields = array('recipe_id', 'list_id', 'order', 'label');
		protected static $db_name = 'RecipeIngredientLists';

		public function members()
		{
			return $this->get_ingredient_list()->members();
		}

		public function get_ingredient_list()
		{
			return IngredientList::fetch_single(array('id' => $this->list_id));
		}

		public function render()
		{
			return template('RecipeIngredientList', array('list' => $this));
		}

		public static function  render_template()
		{
			return template('RecipeIngredientList');
		}
	}

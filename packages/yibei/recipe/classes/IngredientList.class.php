<?php
	class IngredientList extends fetcher
	{
		public static $fields = array();
		protected static $db_name = 'IngredientLists';

		public function members()
		{
			return IngredientListMember::fetch(array('list_id' => $this->id));
		}

	}

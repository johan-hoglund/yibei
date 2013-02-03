<?php
	class VersioningPatchRecipeRestructure2 implements VersioningPatch
	{
		public static function get_version()
		{
			return 20;
		}

		public static function execute()
		{
			mysql_query('ALTER TABLE  `RecipeIngredientLists` CHANGE  `label`  `label` VARCHAR( 25 ) CHARACTER SET utf8 COLLATE utf8_swedish_ci NULL');
			mysql_query('ALTER TABLE `IngredientListMembers` DROP `substitute_for`');
		}
	}

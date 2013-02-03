<?php
	class VersioningPatchAllowRecipeNullDescription implements VersioningPatch
	{
		public static function get_version()
		{
			return 21;
		}

		public static function execute()
		{
			mysql_query('ALTER TABLE  `Recipes` CHANGE  `description`  `description` TEXT CHARACTER SET utf8 COLLATE utf8_swedish_ci NULL');
		}
	}

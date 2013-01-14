<?php
	class VersioningPatchCOmmodityDescriptions implements VersioningPatch
	{
		public static function get_version()
		{
			return 17;
		}

		public static function execute()
		{
			mysql_query('ALTER TABLE  `Commodities` ADD  `description` TEXT NOT NULL ,
			ADD  `user_id` INT NOT NULL ,
			ADD  `modification_time` DATETIME NOT NULL ,
			ADD  `is_primary` BOOLEAN NOT NULL ,
			ADD  `status` VARCHAR( 20 ) NOT NULL ,
			ADD  `parent_relation` VARCHAR( 20 ) NOT NULL');
		}
	}

<?php
	class VersioningPatchCommodityImagecropId implements VersioningPatch
	{
		public static function get_version()
		{
			return 14;
		}

		public static function execute()
		{
			mysql_query('ALTER TABLE  `Commodities` ADD  `main_imagecrop_id` INT NOT NULL');
		}
	}

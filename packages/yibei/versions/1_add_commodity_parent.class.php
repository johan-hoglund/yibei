<?php
	class VersioningPatchAddCommodityParent implements VersioningPatch
	{
		public static function get_version()
		{
			return 12;
		}

		public static function execute()
		{
			mysql_query('ALTER TABLE  `Commodities` ADD  `parent_commodity_id` INT NULL , ADD INDEX (  `parent_commodity_id` )');
		}
	}

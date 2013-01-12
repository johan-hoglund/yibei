<?php
	class VersioningPatchImagecropAllowNull implements VersioningPatch
	{
		public static function get_version()
		{
			return 15;
		}

		public static function execute()
		{
			mysql_query('ALTER TABLE  `imagecrops` CHANGE  `handle`  `handle` VARCHAR( 50 ) CHARACTER SET utf8 COLLATE utf8_swedish_ci NULL ,
			CHANGE  `x1`  `x1` INT( 11 ) NULL ,
			CHANGE  `x2`  `x2` INT( 11 ) NULL ,
			CHANGE  `y1`  `y1` INT( 11 ) NULL ,
			CHANGE  `y2`  `y2` INT( 11 ) NULL');
		}
	}

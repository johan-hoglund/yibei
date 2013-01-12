<?php
	class VersioningPatchAddImagecropTable implements VersioningPatch
	{
		public static function get_version()
		{
			return 13;
		}

		public static function execute()
		{
			mysql_query('CREATE TABLE  `yibei`.`imagecrops` (
			`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
			`handle` VARCHAR( 50 ) NOT NULL ,
			`x1` INT NOT NULL ,
			`x2` INT NOT NULL ,
			`y1` INT NOT NULL ,
			`y2` INT NOT NULL
			) ENGINE = INNODB;');
		}
	}

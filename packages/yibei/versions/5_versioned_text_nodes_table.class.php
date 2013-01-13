<?php
	class VersioningPatchVersionedTextNodesTable implements VersioningPatch
	{
		public static function get_version()
		{
			return 16;
		}

		public static function execute()
		{
			mysql_query('CREATE TABLE  `yibei`.`VersionedTextNodes` (
			`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
			`key` VARCHAR( 50 ) NOT NULL ,
			`date` DATETIME NOT NULL ,
			`user_id` INT NOT NULL ,
			`text` TEXT NOT NULL
			) ENGINE = INNODB;');
		}
	}

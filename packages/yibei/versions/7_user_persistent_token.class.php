<?php
	class VersioningPatchPersistentUserToken implements VersioningPatch
	{
		public static function get_version()
		{
			return 18;
		}

		public static function execute()
		{
			mysql_query('ALTER TABLE  `Users` ADD  `persistent_token` VARCHAR( 40 ) NOT NULL , ADD INDEX (  `persistent_token` )');
		}
	}

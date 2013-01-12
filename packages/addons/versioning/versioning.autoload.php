<?php
	
	hook::register('engine_all_files_loaded', function() {
		$q = 'SELECT version FROM Versioning ORDER BY version DESC LIMIT 1';
		$r = mysql_query($q);
		if(mysql_num_rows($r) > 0)
		{
			$data = mysql_fetch_assoc($r);
			$version = $data['version'];
		}
		else
		{
			$version = 0;
		}

		$patches = implementers('VersioningPatch');

		usort($patches, function($a, $b) {
			if($a::get_version() == $b::get_version())
			{
				return 0;
			}
			return $a::get_version() < $b::get_version() ? -1 : 1;

		});

		foreach($patches AS $patch)
		{
			if($patch::get_version() > $version)
			{
				$lockfile = fopen(PATH_TEMP . 'versioning.lock', 'w');

				if(!flock($lockfile, LOCK_EX))
				{
					break;
				}
				$patch::execute();
				$q = 'INSERT INTO Versioning (version, patch_date, notes) VALUES("' . $patch::get_version() . '", "' . date('Y-m-d H:i:s') . '", "")';
				mysql_query($q);
				flock($lockfile, LOCK_UN);
			}
		}

	});

	interface VersioningPatch
	{
		public static function execute();
		public static function get_version();
	}


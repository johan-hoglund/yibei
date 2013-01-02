<?php
	ini_set('error_reporting', E_ALL | E_STRICT);
	define('DB_ENGINE', 'mysql');
	define('DB_HOST', 'localhost');
	define('DB_DATABASE', 'yibei');
	define('DB_USER', 'yibei');
	define('DB_PASS', 'yibei');
	define('DB_CHARSET', 'utf8');

	define('DEBUG_SHOW', false);

	define('DEFAULT_USER', 'www-data');

	define('EXTERNAL_ROOT', 'http://yibei.local/');

	# Autoconfiguring
	if(!defined('PATH_ROOT'))
	{
		define('PATH_ROOT', substr(__FILE__, 0, strrpos(__FILE__, '/')+1));
	}
	define('PATH_PACKAGES', PATH_ROOT . 'packages/');
	define('PATH_STORAGE', '/var/www/yibei.local/storage/');
	define('PATH_CACHE', '/var/www/yibei.local/cache/');
	define('PATH_LOG', '/var/www/yibei.local/log/');
	define('PATH_TEMP', '/var/www/yibei.local/temp/');
	define('PATH_BACKUP', PATH_ROOT . 'backups/');


	define('BASE_URL', '/');


<?php
	if(!@mysql_connect(DB_HOST, DB_USER, DB_PASS))
	{
		throw new Exception('Could not connect to database: ' . mysql_error());
	}
	mysql_select_db(DB_DATABASE);
	mysql_query('SET NAMES "' . DB_CHARSET . '"');




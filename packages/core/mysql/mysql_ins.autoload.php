<?php

	function mysql_ins($query)
	{
		if(mysql_query($query))
		{
			return mysql_insert_id();
		}
		else
		{
			throw new Exception(mysql_error());
		}
	}

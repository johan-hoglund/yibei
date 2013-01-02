<?php
	function mysqls($args = array())
	{
		if(!is_array($args))
		{
			throw new Exception('mysqls called with illegal argument (perhaps you forgot to encapsulate the query in an array?)');
		}
		if(isset($args['maxage']))
		{
			debug::log('Maxage set');
			debug::log($args);
			$cache = new cache(md5($args['query']));
			
			if ($cache->get('modified_at') + $args['maxage'] > time())
			{
				$return = mysqls_raw($args['query']);
				$cache->quick_save($return);
				return $return;
			}
			else
			{
				return $cache->get('data');
			}
		}
		else
		{
			return mysqls_raw($args['query']);
		}
	}
	
	function mysqls_raw($query)
	{
		if($result = @mysql_query($query))
		{
			$return = array();
			while ($data = mysql_fetch_assoc($result))
			{
				$return[] = $data;
			}	
			return $return;
		}
		else
		{
			throw new Exception('Mysql syntax error ' . $query);
		}
	}

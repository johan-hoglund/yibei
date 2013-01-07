<?php
	session_start();
	try
	{
		require_once '../../../engine.php';
	}
	catch(Exception $e)
	{
		die($e->getMessage());
	}
	
	$uri = $_SERVER['REQUEST_URI'];

	if(strpos($uri, '?')) // mod_rewrite prevents querystring parsing
	{
		$_SERVER['QUERY_STRING'] = substr($uri, strpos($uri, '?')+1);
		parse_str(substr($uri, strpos($uri, '?')+1), $_GET);
		$uri = substr($uri, 0, strpos($uri, '?'));			
	}
	$uri = (substr($uri, -1) == '/') ? substr($uri, 0, -1) : $uri;

	if(get_magic_quotes_gpc() == 1)
	{
		$old_post = $_POST;
		$_POST = array();
		foreach($old_post AS $key => $value)
		{
			if(is_array($value))
			{
				foreach($value AS $vkey => $vvalue)
				{
					$_POST[stripslashes($key)][stripslashes($vkey)] = stripslashes($vvalue);
				}
			}
			if(!is_array($value))
			{
				$_POST[stripslashes($key)] = stripslashes($value);
			}
		}

		$old_get = $_GET;
		$_GET = array();	
		foreach($old_get AS $key => $value)
		{
			if(!is_array($value))
			{
				$_GET[htmlspecialchars(stripslashes($key))] = htmlspecialchars(stripslashes($value));
			}
		}
	}

	hook::execute('bidding');

	$page = false;
	$classes = get_declared_classes();
	foreach($classes AS $class)
	{
		if(in_array('page', class_implements($class)))
		{
			$reflector = new ReflectionClass($class);
			if(!$reflector->isAbstract())
			{
				$patterns[$class] = call_user_func(array($class, 'get_url_pattern'));
			}
		}
	}
	
	$winner = false;
	$top_bid = 0;
	foreach($patterns AS $class => $pattern_set)
	{
		foreach($pattern_set AS $regexp => $bid)
		{
			if($regexp{0} != '#' && substr($regexp, -1) != '#')
			{
				debug::log($regexp . ' ' . $class);
			}
			if(preg_match($regexp, $uri))
			{
				if($bid > $top_bid && (!method_exists($class, 'accepts') || $class::accepts($uri)))
				{
					$top_bid = $bid;
					$winner = $class;
				}
			}
		}
	}

	if($winner == false)
	{
		echo 'ERROR: Could not find any class matching the given uri';
		exit;
	}
	
	try
	{
		$page = new $winner();
		echo $page->output($uri);
		hook::execute('last_call');
	}
	catch(NotFoundException $e)
	{
		header('Status: 404 Not Found');
		echo '<h1>404: Not found</h1><p>The document you requested does not reside on this server.</p>';
	}
	catch(AccessDeniedException $e)
	{
		header('Status: 403 Request Forbidden');
		echo '<h1>403: Request forbidden</h1><p>You are not authorized to access this resource at the moment.</p>';
	}
	catch(Exception $e)
	{
		echo 'Uncaugh exception<pre>';
		print_r($e);
		error_log($e);
	}



<?php

	function mb_htmlentities($str)
	{
		return htmlentities($str, ENT_COMPAT, 'UTF-8');
	}


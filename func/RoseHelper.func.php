<?php

function require_cache ($file)
{
	static $required = array ();

	if (!array_key_exists($file, $required))
	{
		require_once $file;
		$required [$file] = TRUE;
	}
}

function dump ($obj)
{
	echo '<pre>';
	print_r ($obj);
	echo '</pre>';
}


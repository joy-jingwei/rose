<?php

class Conf
{
    private static $isLoaded = array();
    private static $confData = array();

	static function load($paths)
	{
		if (is_string($paths)) 
		{
			$paths = array($paths);
		}

		foreach($paths as $path) 
		{
			if (isset(self::$isLoaded[$path])) continue;

			if (is_readable($path)) 
			{
                require_once $path;
				self::$isLoaded[$path] = true;
			} 
			else 
			{
                trigger_error("$path neither such file nor directory",E_USER_NOTICE);
			}
		}
	}

	static function get($key,$default=null)
	{
		if (isset(self::$confData[$key])) 
		{
			return self::$confData[$key];
		}
		
		return $default;
	}

	static function set($key,$value)
	{
		self::$confData[$key] = $value;
	}

	static function has($key)
	{
		return isset(self::$confData[$key]);
	}

	static function clear()
	{
		self::$isLoaded = array();
		self::$confData = array();
	}
}
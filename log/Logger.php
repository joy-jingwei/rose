<?php

class Logger 
{	
	private static $_log = NULL;
	
	public static function init (ILogStrategy $log)
	{
		self::$_log = $log;
	}
	
	public static function error ($info)
	{
		$log = self::$_log;
		
		return $log->log ($info, LOG_ERR);
	}
	
	public static function warning ($info)
	{
		$log = self::$_log;
		
		return $log->log ($info, LOG_WARNING);
	}
	
	public static function info ($info)
	{
		$log = self::$_log;
		
		return $log->log ($info, LOG_INFO);
	}
}
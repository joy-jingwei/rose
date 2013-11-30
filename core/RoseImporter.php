<?php

class RoseImporter
{
	protected static $root = _ROSE_PATH_;
	protected static $extension = '.php';

	private static $_importedFiles = array ();

	public static function autoload ($className)
	{
		if (!array_key_exists ($className, self::$_importedFiles))
			return NULL;
		
		$fullFileName = self::$_importedFiles [$className];
		require_cache ($fullFileName);
	}
	
	public static function import ()
	{
		$files = func_get_args();

		foreach ($files as $f)
		{
			$fileFullName = static::$root . str_replace('::', DS, $f) . static::$extension;
			$fileSegements = explode ('::', $f);
			$className = array_pop($fileSegements);

			if (isset (self::$_importedFiles [$className]) && 
				self::$_importedFiles [$className] !== $fileFullName)
			{
				$anotherFile = self::$_importedFiles [$className];
				trigger_error("the imported file '$anotherFile' conflict with '$fileFullName'", E_USER_WARNING);
			}

			self::$_importedFiles [$className] = $fileFullName;
		}
	}
}

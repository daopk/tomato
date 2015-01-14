<?php

/**
* File Loader
*/
class File_Loader_TM_Helper
{
	private static $instance = null;

	private function __construct(){}

	public function load($value='')
	{
		echo "loaded $value<br>";
	}

	public static function GetInstance()
	{
		if(self::$instance != null)
		{
			return self::$instance;
		}
		self::$instance = new File_Loader_TM_Helper();
		return self::$instance;
	}
}
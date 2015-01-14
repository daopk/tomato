<?php

/**
* Setting helper
*/
class Setting_TM_Helper
{
	
	private static $instance = null;

	private function __construct(){}

	public function LoadConfig($value='')
	{
		if(!empty($value) && file_exists(TOMATO_DIR_APP.'config'.DS.$value.'.php'))
			return include TOMATO_DIR_APP.'config'.DS.$value.'.php';
	}

	public static function GetInstance()
	{
		if(self::$instance != null)
		{
			return self::$instance;
		}
		self::$instance = new Setting_TM_Helper();
		return self::$instance;
	}
}
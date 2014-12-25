<?php

/**
* 
*/
class _Tomato
{
	public static $config = null;
	public static $router = null;
	

	public static function run()
	{
		self::$config = TM_Helper::load('json')->load(APP_DIR.DS.'config'.DS.'main.json');
		self::$router = new TM_Router(self::$config);
		self::$router->request();
	}
}
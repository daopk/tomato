<?php

/**
* 
*/
class TM_Helper
{
	public static $helpers = array();
	public static function load($name)
	{
		if(!isset(self::$helpers[$name]))
		{
			$helper = $name.'_helper';
			require_once CORE_DIR.DS.'helpers'.DS.$helper.'.php';
			self::$helpers[$name] = new $helper;
		}
		return self::$helpers[$name];
	}
}
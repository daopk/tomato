<?php


class JsonConfig
{
	private static $config;

	public static function setConfig($config)
	{
		self::$config = $config;
	}
	
	public static function getConfig()
	{
		return self::$config;
	}

	public static function getConfigByName($name)
	{
		$params = explode('/', $name);
		$result = self::getConfig();
		foreach ($params as $value) {
			if($value != '')
				$result = $result[$value];
		}
		return $result;
	}

	public static function load($pathfile)
	{
		$contents = file_get_contents($pathfile); 
		self::setConfig(json_decode($contents,true));
	}

	public static function write($array, $pathfile)
	{
		file_put_contents($pathfile, json_encode($array),LOCK_EX);
	}
}
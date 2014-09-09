<?php


class JsonConfig
{
	public static $_config;

	function __construct()
	{
		# code...
	}

	public static function load($pathfile)
	{
		$contents = file_get_contents($pathfile); 
		self::$_config = json_decode($contents,true);
		return self::$_config;
	}

	public static function write($array, $pathfile)
	{
	//	$jsonfile = fopen($pathfile, 'w');
	//	fclose($jsonfile);
		file_put_contents($pathfile, json_encode($array),LOCK_EX);
	}

	public static function Config()
	{
		return self::$_config;
	}
}
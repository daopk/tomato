<?php

/**
* Database helper
*/
class Database_TM_Helper
{
	private static $db;
	public static function Connect($config)
	{
		switch ($config['driver']) {
			case 'mysql':
			$pdo_h = self::PDO_Mysql($config);
			break;
			case 'sqlite':
			$pdo_h = self::PDO_Sqlite($config);
			break;
		}

		if(isset($pdo_h))
		{
			self::$db = new NotORM($pdo_h);
			return self::$db;
		}
	}

	private static function PDO_Mysql($config)
	{
		$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
		return new PDO('mysql:host='.$config['host'].';dbname='.$config['db_name'], 
			$config['user'], $config['pass'], $options);			
	}

	private static function PDO_Sqlite($config)
	{
		return new PDO('sqlite:'.TOMATO_DIR.$config['file']);
	}

	public static function GetDatabase()
	{
		return self::$db;
	}
}
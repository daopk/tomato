<?php

/**
 * TM_Model class
 */
class TM_Model
{
	var $db;

	function __construct()
	{
		$config = _Tomato::$config->database;
		if(isset($config))
			$this->db = $db = new NotORM($this->ConnectDB($config));
	}

	private function ConnectDB($config)
	{

		switch ($config->driver) {
			case 'mysql':
				$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
				return new PDO('mysql:host='.$config->host.';dbname='.$config->db_name, $config->user, $config->pass, $options);
				break;
			case 'sqlite':
				return new PDO('sqlite:'.APP_DIR.$config->file);
				break;
		}
	}
}
<?php

$dbconfig = JsonConfig::GetConfigByName('database');
if($dbconfig != null)
{
	require_once 'NotORM.php';
	extract(JsonConfig::GetConfigByName('database'));

	$options = array(
		PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
		); 

	try {
		$connection = new PDO('mysql:host='.$host.';dbname='.$dbname, $username, $password, $options);
		$db = new NotORM($connection);	
	} catch (Exception $e) {
		throw new DatabaseException("Can't connect database. Check your config in application/configuration/config.json");	
	}
}
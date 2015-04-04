<?php

/**
* Model
*/
class Model_TM_Module
{
	function __construct()
	{
		
	}
}

/**
* 
*/
class TM_Model
{	
	protected $db;
	function __construct()
	{
		if(file_exists(TOMATO_DIR_APP_CONFIG.'database.php'))
		{
			$dbConfig = include TOMATO_DIR_APP_CONFIG.'database.php';
			$this->db = Load_TM_Helper::module('database')->GetDB();
		}
	}
}
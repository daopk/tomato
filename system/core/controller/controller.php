<?php

/**
* Controller
*/
class TM_Controller
{
	var $db, $load, $route;
	function __construct()
	{
		if(file_exists(TOMATO_DIR_APP_CONFIG.'database.php'))
		{
			$dbConfig = include TOMATO_DIR_APP_CONFIG.'database.php';
			$this->db = Database_TM_Helper::connect($dbConfig);
		}
		$this->load = new Load_TM_Helper();
	}

	public function SetRoute($route)
	{
		$this->route = $route;
	}

	public function View($viewName, $model = null)
	{
		if(file_exists($this->route['directory'].$this->route['controller'].'.php'))
		{
			$view = new TM_View($this->route, $model);
		}
	}
}
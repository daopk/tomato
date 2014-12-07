<?php

/**
* 
*/
class RouterConfig
{
	public $controller;
	public $directory;
	public $action;
	public $params = array();

	function __construct()
	{
		$this->controller = JsonConfig::$_config['base']['router']['defaut_controller'];
		$this->action = JsonConfig::$_config['base']['router']['defaut_action'];
		$this->directory = '';
	}
}
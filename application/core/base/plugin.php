<?php

/**
 * 
 */
class TM_Plugin
{
	var $register;

	//
	// List
	//
	private $Controllers = array();
	private $Models;

	function __construct()
	{
		$register = new TM_P_Register($this);
	}

	public function Register($controller)
	{
		if(!in_array($controller, $this->Controllers))
			$this->Controllers += $controller;
	}
}


/**
* 
*/
class TM_P_Register
{
	private $plugin;
	function __construct(&$plugin)
	{
		$this->plugin = &$plugin;
	}

	public function Controller($c_name)
	{
		if(!in_array($c_name, $this->plugin->Controllers))
			$this->plugin->Controllers += $c_name;
	}

	public function Model($m_name)
	{
		if(!in_array($c_name, $this->plugin->Models))
			$this->plugin->Models += $m_name;
	}
}
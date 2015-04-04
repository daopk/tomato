<?php

require 'base.controller.php';

/**
* Error 
*/
class Controller_TM_Module
{
	protected $route;
	protected $controller;

	public function CheckRequest(&$route)
	{
		$this->route = $route;
		$c_name = trim(strtolower($route['controller']));
		$c_path =  TOMATO_DIR_APP_CTRL.$route['directory'].$c_name.'.php';
		if(file_exists($c_path))
		{
			require $c_path;
			try {
				$this->controller = new $c_name;
				$this->controller->setRoute($route);
			} catch (Exception $e) {
				if(get_class($e) == 'PDOException')
					$this->SetError("Can't connect database!");
				else
					$this->SetError("Not found controller $c_name");
				return null;
			}
			$m_name = trim(strtolower($route['action']));
			if(!method_exists($this->controller, $m_name) || 
				in_array($m_name, get_class_methods('TM_Controller')))
				$this->SetError("Not found action $m_name");
			else 
			{
				call_user_func_array(array($this->controller, $m_name), $route['params']);
			}
		}
		else $this->SetError("Not found controller ".$c_name);
	}

	public function SetError($message)
	{
		header("HTTP/1.1 404 Not Found");
		require TOMATO_DIR_APP.'errors'.DS.'404.php';
	}
}
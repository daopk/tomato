<?php

/**
* 
*/
class RouterConfig
{
	private $controller;
	private $directory;
	private $action;
	private $params = array();

	public function setController($controller)
	{
		$this->controller = $controller;
	}

	public function getController()
	{
		return $this->controller;
	}

	public function setDirectory($directory)
	{
		$this->directory = $directory;
	}

	public function addDirectory($subDir)
	{
		$this->directory .= DS.$subDir;
	}

	public function getDirectory()
	{
		return $this->directory;
	}

	public function setAction($action)
	{
		$this->action = $action;
	}
	
	public function getAction()
	{
		return $this->action;
	}

	public function setParams($params)
	{
		if(is_array($params))
			$this->params = $params;
	}
	
	public function getParams()
	{
		return $this->params;
	}

	public function addParams($param)
	{
		array_push($this->params, $param);
	}

	function __construct()
	{
		$this->setController(JsonConfig::GetConfigByName('base/router/defaut_controller'));
		$this->setAction(JsonConfig::GetConfigByName('base/router/defaut_action'));
		$this->setDirectory('');
	}
}
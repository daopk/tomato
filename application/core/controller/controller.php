<?php

/**
* 
*/
class Controller
{
	public $template;

	function __construct()
	{	
	}

	public function View($viewName, $model = null)
	{
		$view = new View($this->template);
		$view->load($this, $viewName, $model);
	}

	public function DirectView($controllerName, $viewName, $model = null)
	{
		$view = new View($this->template);
		$view->load($controllerName, $viewName, $model);
	}

	public function PartialView($viewName, $model = null)
	{
		$view = new PartialView($viewName, $model);
	}
}
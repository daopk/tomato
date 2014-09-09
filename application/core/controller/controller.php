<?php

/**
* 
*/
class Controller
{
	function __construct()
	{
		
	}


	public function View($viewName, $model = null)
	{
		if($model)
            View::$model = $model;

		$view = new View($this, $viewName);        

        return $view;
	}

	public function DirectView($controllerName, $viewName, $model = null)
	{
		if($model)
            View::$model = $model;

		$view = new View($controllerName, $viewName);       

        return $view;
	}
}
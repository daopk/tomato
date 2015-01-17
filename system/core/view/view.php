<?php

class TM_View{

	protected $template, $route;

	function __construct($route, &$model = null)
	{
		$viewPath = str_replace('controllers', 'views', $route['directory']) . 
			$route['controller'] . DS . $route['action'].'.php';
		$this->template = new TM_Template($viewPath, $model);
	}

	public function Render()
	{
		$this->template->render();
	}
}
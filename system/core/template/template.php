<?php

class TM_Template{
	protected $model, $viewPath;

	function __construct($viewPath, $model = null)
	{
		$this->viewPath = $viewPath;
		$this->model = $model;

		dump($this);
	}

	protected function RenderBody()
	{
		if(file_exists($this->viewPath))
			include $this->viewPath;
		else throw new Exception("Can't find path view {$this->pathView}", 1);
		
	}
}
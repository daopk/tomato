<?php

class TM_Template{
	protected $model, $viewPath;
	private static $rendered = false;

	function __construct($viewPath, &$model = null)
	{
		$this->viewPath = $viewPath;
		$this->model = $model;
	}

	public function Render()
	{
		if(!self::$rendered)
		{
			self::$rendered = true;
			$model = &$this->model;
			require_once TOMATO_DIR_THEME.'default'.DS.'index.php';
		} else throw new Exception("Can't call Render method!", 1);
		
	}

	protected function RenderBody()
	{
		if(file_exists($this->viewPath))
		{
			$model = &$this->model;
			include $this->viewPath;
		}
		else throw new Exception("Can't find path view {$this->pathView}", 1);	
	}

	protected function RenderStyle()
	{

	}

	protected function RenderScript()
	{
		
	}
}
<?php

/**
* 
*/
class View
{
	public $pathView;
	public static $model;
	
	function __construct($controller, $viewName)
	{
		if(is_string($controller)) 
			$this->pathView = VIEW_DIR.DS.strtolower($controller).DS.$viewName.'.php';	
		else
		{
			if(get_class($controller) == 'Error')
				$this->pathView = APP_DIR.DS.'errors'.DS.'views'.DS.$viewName.'.php';
			else 
				$this->pathView = VIEW_DIR.DS.strtolower(get_class($controller)).DS.$viewName.'.php';
		}

		Template::$name = JsonConfig::$_config['base']['template'];

		$this->Render();
	}

	
	public function Render()
	{
		Template::$view = $this;

		require_once(TEMPLATE_DIR.DS.Template::$name.DS.'index.php');
	}

	public static function Title()
	{
		echo JsonConfig::$_config['base']['title'];
	}
}
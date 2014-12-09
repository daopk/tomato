<?php

/**
* 
*/
class View
{
	public $pathView;
	public $template;

	public static $title;
	public static $model;
	
	function __construct($template)
	{
		if(isset($template) && realpath(TEMPLATE_DIR.DS.$template))
			$this->template = TEMPLATE_DIR.DS.$template;
		else $this->template = TEMPLATE_DIR.DS.JsonConfig::GetConfigByName('base/template');
	}

	public function load($controller, $viewName, $model)
	{
		if(is_string($controller)) 
			$this->pathView = VIEW_DIR.Router::GetInstance()->getDirectory() . 
		DS.strtolower($controller).DS.$viewName.'.php';	
		else
		{
			if(get_class($controller) == 'Error')
				$this->pathView = APP_DIR.DS.'errors'.DS.'views'.DS.$viewName.'.php';
			else 
				$this->pathView = VIEW_DIR.Router::GetInstance()->getDirectory() . 
			DS.strtolower(get_class($controller)).DS.$viewName.'.php';
		}

		self::$model = $model;

		if (file_exists($this->template.DS.'config.php')) {
			require_once($this->template.DS.'config.php');
		}

		$this->Render();
	}

	
	public function Render()
	{
		Template::$view = $this;

		require_once($this->template.DS.'index.php');
	}

	public static function Title()
	{
		echo JsonConfig::GetConfigByName('base/title');
	}
}
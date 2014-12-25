<?php

/**
* 
*/
class TM_Controller
{
	var $view = null;
	var $template;
	var $db;
	var $params;

	private $directory;
	public function setDirectory($dir)
	{
		$this->directory = $dir;
	}
	public function getDirectory()
	{
		return $this->directory;
	}

	function __construct()
	{
		$config = _Tomato::$config->database;
		if(isset($config))
			$this->db = $db = new NotORM($this->ConnectDB($config));
	}

	public function view($viewname, $model = NULL)
	{
		$path_view = $this->directory.strtolower(get_class($this)).DS.$viewname.'.php';
		$this->view = new TM_View($path_view, $this->template, $model);
		$this->view->display();
	}

	public function DirectView($controllerName, $viewname, $model = NULL)
	{
		$path_view = $controllerName.DS.$viewname.'.php';
		$this->view = new TM_View($path_view, $this->template, $model);
		$this->view->display();
	}

	public function PartialView($viewname, $model = NULL)
	{
		$path_view = $viewname.'.php';
		require_once 'partial_view.php';
		$this->view = new TM_Partial_View($path_view, $model);
		$this->view->display();
	}

	public function ShowError($error_name, $message = NULL)
	{
		$path_view = $error_name.DS.'index.php';
		$this->view = new TM_View($path_view, $this->template, $message);
		$this->view->display();
	}

	private function ConnectDB($config)
	{

		switch ($config->driver) {
			case 'mysql':
				$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
				return new PDO('mysql:host='.$config->host.';dbname='.$config->db_name, $config->user, $config->pass, $options);
				break;
			case 'sqlite':
				return new PDO('sqlite:'.APP_DIR.$config->file);
				break;
		}
	}
}
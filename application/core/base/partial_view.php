<?php

/**
* 
*/
class TM_Partial_View extends TM_View
{
	var $path, $model;

	function __construct($path, $model = NULL)
	{
		$this->path = $path;
		$this->model = &$model;
	}

	function display()
	{
		$model = &$this->model;
		require_once APP_DIR.DS.'views'.DS.$this->path;
	}
}
<?php

/**
* 
*/
class TM_View
{
	var $path, $template;

	function __construct($path, $template, $model)
	{
		$this->path = $path;
		if(empty($template))
			$template = _Tomato::$config->template;
		$this->template = new TM_Template($template, $model);
	}

	function display()
	{
		$this->template->render($this->path);
	}
}
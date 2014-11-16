<?php

/**
* 
*/
class PartialView extends View
{
	function __construct($viewName)
	{
		$this->pathView = VIEW_DIR.DS.$viewName.'.php';
		require_once($this->pathView);
	}
}
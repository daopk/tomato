<?php

/**
* 		
*/
class Load_Helper
{
	public function model($modelName)
	{
		include_once APP_DIR.DS.'models'.DS.$modelName.'.php';
		$modelName .= '_M';
		return new $modelName;
	}
}
<?php

/**
* Load helper
*/
class Load_TM_Helper
{
	protected static $models = array();
	protected static $modules = array();
	
	public function model($modelName)
	{
		if(!array_key_exists($modelName, self::$models))
		{
			$pathModel = TOMATO_DIR_APP_MODEL.strtolower($modelName).'.php';
			if(file_exists($pathModel))
			{
				include_once $pathModel;
				$newModelName = $modelName.'_M';
				$model = new $newModelName;
				self::$models[$modelName] = $model;
			} else throw new Exception("Cant load model $modelName", 1);
		}
		return self::$models[$modelName];
	}

	public function module($moduleName)
	{
		echo "Load module $moduleName";
	}
}
<?php

/**
* Load helper
*/
class Load_TM_Helper
{
    protected static $modules = array();
    protected static $libraries = array();
    protected static $models = array();

    public static function module($module_name)
    {
        if(!array_key_exists($module_name, self::$modules))
        {
            if(file_exists(TOMATO_DIR_SYSTEM_MODULE.$module_name.DS.$module_name.'.php'))
            {
                require TOMATO_DIR_SYSTEM_MODULE.$module_name.DS.$module_name.'.php';
                $m_name = $module_name . '_TM_MODULE';
                self::$modules[$module_name] = new $m_name;
            }
            else throw new Exception("Can't load module $module_name", 1);
        }
        return self::$modules[$module_name];
    }

    public static function library($library_name)
    {
        if(!array_key_exists($library_name, self::$libraries))
        {
            if(strpos($library_name, '\\'))
                $lib_name = str_replace('\\', DS, $library_name);
            else $lib_name = $library_name.DS.$library_name;

            if(file_exists(TOMATO_DIR_SYSTEM_LIBRARY.strtolower($lib_name).'.php'))
            {
                require TOMATO_DIR_SYSTEM_LIBRARY.strtolower($lib_name).'.php';
                self::$libraries[$library_name] = new $library_name;
                return self::$libraries[$library_name];
            }
            else throw new Exception("Can't load library ".TOMATO_DIR_SYSTEM_LIBRARY.strtolower($lib_name).'.php', 1);
        }
        return self::$libraries[$library_name];
    }

    public function model($modelName)
    {
        Load_TM_Helper::module('model');
        if(!array_key_exists($modelName, self::$models))
        {
            $pathModel = TOMATO_DIR_APP_MODEL.strtolower($modelName).'.php';
            if(file_exists($pathModel))
            {
                include_once $pathModel;
                $newModelName = $modelName.'_M';
                $model = new $newModelName;
                self::$models[$modelName] = $model;
            } else throw new Exception("Cant load model $modelName ($pathModel)", 1);
        }
        return self::$models[$modelName];
    }
}
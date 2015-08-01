<?php

// 1. Increase PHP's memory_limit
@ini_set('memory_limit', '-1');
@set_time_limit(0);

// 2. Set default response content type
header('Content-type: text/html; charset=utf-8');

// 3. Require the needed setting files
if(file_exists(TOMATO_DIR.'system'.DS.'setting'.DS.'constant.php'))
    require(TOMATO_DIR.'system'.DS.'setting'.DS.'constant.php');

if(file_exists(TOMATO_DIR_APP.'config'.DS.'system.php'))
    require(TOMATO_DIR_APP.'config'.DS.'system.php');

// 4. Enable debug mode
if(defined('TOMATO_DEBUG') && TOMATO_DEBUG)
{
    require(TOMATO_DIR_SYSTEM_LIBRARY.'tmdebug'.DS.'tmdebug.php');
    TmDebug\Debugger::enable(TmDebug\Debugger::DEVELOPMENT);
    TmDebug\Debugger::$email = 'dev@daofresh.me';
} else error_reporting(0);

// 5. Force request
switch (FORCE_REQUEST) {
    case 'WWW':
    if (substr($_SERVER['HTTP_HOST'], 0, 4) !== 'www.') {
        header('Location: http'.(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on' ? 's':'').'://www.' . $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        exit;
    }
    break;
    case 'NON_WWW':
    if (substr($_SERVER['HTTP_HOST'], 0, 4) === 'www.') {
        header('Location: http'.(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on' ? 's':'').'://' . substr($_SERVER['HTTP_HOST'], 4).$_SERVER['REQUEST_URI']);
        exit;
    }
    break;
}

// 6. Register auto load
spl_autoload_register(function($class) {
    if(substr($class, -10) == '_TM_Helper'){
        $path = TOMATO_DIR_SYSTEM_HELPER.str_replace('_tm_', '.', strtolower($class)).'.php';
    }
    else{
        $name = strtolower($class);
        if(strpos($name, '\\'))
        {
            $name = str_replace('\\', DS, $name);
            $path = TOMATO_DIR_SYSTEM_LIBRARY.$name.'.php';
        }
        else
            $path = TOMATO_DIR_SYSTEM_LIBRARY.$name.DS.$name.'.php';
    }

    if(file_exists($path)){require_once($path);}
});

// Run application
Load_TM_Helper::module('tomato')->Run();
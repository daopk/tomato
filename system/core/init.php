<?php

// Todo:
// 1. Increase PHP's memory_limit
// 2. Require the needed setting files
// 3. Register auto load
// Config session setting
// 3. 

// 1. Increase PHP's memory_limit
@ini_set('memory_limit', '-1');
@set_time_limit(0);

header('Content-type: text/html; charset=utf-8');

// 2. Require the needed setting files
if(file_exists(TOMATO_DIR.'system'.DS.'core'.DS.'setting'.DS.'constant.php'))
{
	require(TOMATO_DIR.'system'.DS.'core'.DS.'setting'.DS.'constant.php');
}

if(file_exists(TOMATO_DIR_APP.'config'.DS.'system.php'))
{
	require(TOMATO_DIR_APP.'config'.DS.'system.php');
}

if(defined('TOMATO_DEBUG') && TOMATO_DEBUG)
{
	require(TOMATO_DIR_SYSTEM_LIBRARY.'tmdebug'.DS.'tmdebug.php');
	TmDebug\Debugger::enable(TmDebug\Debugger::DEVELOPMENT);
	TmDebug\Debugger::$email = 'daofresh@gmail.com';
} else error_reporting(0);

// 3. Register auto load
spl_autoload_register(function($class) {
	if (substr($class, -10) == '_TM_Helper'){
		$path = TOMATO_DIR_SYSTEM_CORE.'helper'.DS.str_replace('_tm_', '.', strtolower($class)).'.php';
	} elseif (substr($class, 0, 3) == 'TM_') {
		$name = str_replace('tm_', '', strtolower($class));
		$path = TOMATO_DIR_SYSTEM_CORE.DS.$name.DS.$name.'.php';
	} else{
		$name = strtolower($class);
		$path = TOMATO_DIR_SYSTEM_LIBRARY.$name.DS.$name.'.php';
	}
	if(file_exists($path)){require_once($path);}
});


// 4. Require tomato class
require(TOMATO_DIR_SYSTEM_CORE.'tomato.php');
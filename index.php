<?php

// Todo: 
// 1. Check php version
// 2. Define necessary constants
// 3. Require init file
// 4. Run application

// 1. Check php version
if (version_compare(phpversion(), '5.4', '<') === true)
{
	exit('Tomato requires PHP 5.4 or newer.');
}

// 2. Define necessary constants

// Directory Seperator
define('DS', DIRECTORY_SEPARATOR);

// Root Directory
define('TOMATO_DIR', dirname(__FILE__).DS);

// Start Time
define('START_TIME', array_sum(explode(' ', microtime())));

// 3. Require init file
require(TOMATO_DIR.'system'.DS.'core'.DS.'init.php');
 
// 4. Run application
TomatoApp::run();
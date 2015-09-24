<?php

// 1. Check php version
if (version_compare(phpversion(), '5.4', '<') === true)
{
   // exit('Tomato requires PHP 5.4 or newer.');
}

// 2. Define necessary constants
// date_default_timezone_set('Asia/Saigon'); // Using this line if you can't change php.ini file
// Start time
define('START_TIME', array_sum(explode(' ', microtime())));

// Directory Seperator
define('DS', DIRECTORY_SEPARATOR);

// Root Directory
define('TOMATO_DIR', dirname(__FILE__).DS);

// 3. Change error log folder for testing
ini_set('error_log', TOMATO_DIR.'log.txt');

// 4. Begin Session
session_start();

// 5. Require init file
require(TOMATO_DIR.'system'.DS.'init.php');
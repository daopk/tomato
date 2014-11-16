<?php

// Define Directory separator
define('DS', DIRECTORY_SEPARATOR);

// Load configurations
require_once(dirname(__DIR__).DS.'application'.DS.'core'.DS.'bootstrap.php');

// Init
require_once(CORE_DIR.DS.'init.php');

if(array_key_exists('url', $_REQUEST))
	$RouterConfig = Router::GetInstance($_REQUEST['url']);
else 
	$RouterConfig = Router::GetInstance('');

Router::Request();


<?php

// Load configurations
require_once('../application/configuration/config.php');

// Init
require_once(CORE_DIR.DS.'init.php');


if(array_key_exists('url', $_REQUEST))
	$RouterConfig = Router::GetInstance($_REQUEST['url']);
else 
	$RouterConfig = Router::GetInstance('');

Router::Request();
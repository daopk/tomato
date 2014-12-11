<?php

// Define Directory separator
define('DS', DIRECTORY_SEPARATOR);

// Load configurations
try {
	require_once(dirname(__DIR__).DS.'application'.DS.'core'.DS.'bootstrap.php');
	Router::Request();
} catch (Exception $e) {
	if(get_class($e)=='DatabaseException')
		TM_Error::show('Database', $e->message);
	else
		TM_Error::show('404', $e->message);
}
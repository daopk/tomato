<?php

// Define Directory separator
define('DS', DIRECTORY_SEPARATOR);

// Load configurations
require_once(dirname(__DIR__).DS.'application'.DS.'core'.DS.'bootstrap.php');

Router::Request();
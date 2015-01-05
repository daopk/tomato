<?php

// Define necessary constants
define('DS', DIRECTORY_SEPARATOR);

//
// Base directory
//
define('BASE_DIR', dirname(__DIR__));

//
// Path of application directory
//
define('APP_DIR', BASE_DIR.DS.'application');

//
// Path of public directory
//
define('PUBLIC_DIR', BASE_DIR.DS.'public');

//
// Path of core directory
//
define('CORE_DIR', APP_DIR.DS.'core');


require_once(APP_DIR.DS.'core'.DS.'bootstrap.php');
/**
 * Main class
 */
class _mainTomato
{
    /**
     * Request 
     */
    function __construct()
    {
    	$this->get_bootstrap();
    }

    private function get_bootstrap()
    {
    	new _bootstrapTomato();
    }

    public function Init()
    {
    	_Tomato::run();
    }
}

$App = new _mainTomato();

$App->Init();
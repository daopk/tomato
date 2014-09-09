<?php

// Define Directiories Name
define('DS', DIRECTORY_SEPARATOR);
define('APP_DIR', dirname(__DIR__));
define('CORE_DIR', APP_DIR.DS.'core');

define('VIEW_DIR', APP_DIR.DS.'views');
define('MODEL_DIR', APP_DIR.DS.'models');
define('TEMPLATE_DIR', APP_DIR.DS.'template');
define('LIB_DIR',  CORE_DIR.DS.'libs');
define('PUBLIC_DIR', dirname(APP_DIR).DS.'public');

// Load configs from json file
require_once(LIB_DIR.DS."json/jsonconfig.php");

JsonConfig::load(__DIR__.DS."config.json");

define('BASE_URL', JsonConfig::$_config['base']['url'].JsonConfig::$_config['base']['path']);
<?php

// Load configs from json file
require_once(LIB_DIR.DS."json/jsonconfig.php");

JsonConfig::load(APP_DIR.DS.'configuration'.DS."config.json");

define('BASE_URL', JsonConfig::$_config['base']['base_url']);
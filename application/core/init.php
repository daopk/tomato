<?php

// Load Models
$current_dir = @opendir(MODEL_DIR);

while ($filename = @readdir($current_dir))
{
	if ($filename != "." and $filename != ".." and $filename != "index.html")
	{
		require_once(MODEL_DIR.DS.$filename);
	}
}

require_once(LIB_DIR.DS.'session'.DS.'session.php');

require_once(CORE_DIR.DS.'controller'.DS.'controller.php');
require_once(CORE_DIR.DS.'view'.DS.'view.php');
require_once(CORE_DIR.DS.'view'.DS.'partial_view.php');
require_once(CORE_DIR.DS.'error/error.php');
require_once(CORE_DIR.DS.'router'.DS.'routerconfig.php');

require_once(CORE_DIR.DS.'template/template.php');

require_once(CORE_DIR.DS.'router/router.php');

// Exceptions
require_once(LIB_DIR.DS.'exception'.DS.'databaseexception.php');
require_once(LIB_DIR.DS.'database'.DS.'database.php');
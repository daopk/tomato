<?php

require_once 'routermap.php';

/**
* TM_Router
*/
class TM_Router
{
	private $controller;

	private $action;

	private $params = array();

	private $directory;

	private static $instance;

    /**
     *
     */
    private function __construct()
	{

    }

    /**
     * @param $config
     * @return TM_Router
     */
    public static function GetInstance()
	{
		if(self::$instance == NULL)
			self::$instance = new TM_Router();
		return self::$instance;
	}

    /**
     * @param $config
     */
    public function Request()
	{
        $result = RouterMap::MappingRoute($_SERVER['REQUEST_URI']);
        echo "<pre>";
        var_dump($result);
	}
}
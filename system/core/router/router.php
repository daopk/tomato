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
        $this->CheckRequest($result);
    }

    public function CheckRequest($route)
    {

        try {
            $c = $this->CheckController($route);
            if($c == false || !$this->CheckAction($c, $route['action']))
            {
                $this->SetError($c);
                $actionName = 'Action404';
            } else $actionName = $route['action'];
            $c->$actionName();
        } catch (Exception $e) {
           dump($e);
           die();
        }
    }

    public function CheckController($route)
    {
        $cPath = $route['directory'].$route['controller'].'.php';

        if(file_exists($cPath))
        {
            require_once $cPath;
            $c = new $route['controller']($route);
            $c->setRoute($route);
        }
        else return null;
        return $c;
    }

    public function CheckAction($controller, $action)
    {
        $re = method_exists($controller, $action);
        return true;
    }

    public function SetError(&$controller)
    {
        require_once TOMATO_DIR_SYSTEM_MODULE.'error'.DS.'controllers'.DS.'error.php';
        $controller = new TM_Error();
    }
}
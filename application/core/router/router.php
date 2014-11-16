<?php

class Router
{
	private static $_instance;

	public static function GetInstance($path)
	{
		if (!isset(self::$_instance)) {
			self::$_instance = self::Init($path);

		}
		return self::$_instance;
	}

	public static function Request()
	{
		if(isset(self::$_instance))
		{
			$instance = (array)(self::$_instance);
			if(file_exists(APP_DIR.DS.'controllers'.DS.$instance['controller'].'.php')) // đã kiểm tra ở Init
			require_once(APP_DIR.DS.'controllers'.DS.$instance['controller'].'.php');
			$c = new $instance['controller']();
			if(method_exists($c, self::$_instance->action)){
				call_user_func_array(array($c, self::$_instance->action), self::$_instance->params);
			}
			else{
				self::$_instance->action = JsonConfig::$_config['base']['router']['defaut_action'];
				call_user_func_array(array($c, self::$_instance->action), self::$_instance->params);
			}
		}
		else{
			self::GetInstance($_REQUEST['url']);
			self::Request();
		}
	}

	// helper
	public static function Init($path)
	{
		$routerconfig = new RouterConfig();
		$routerconfig->controller = JsonConfig::$_config['base']['router']['defaut_controller'];

//		$array = explode('/', filter_var($path=rtrim($path,'/'), FILTER_SANITIZE_URL));
		$array = explode('/', filter_var($path=rtrim($path,'/')));

		if($array[0] != ''){
			if(file_exists(APP_DIR.DS.'controllers'.DS.$array[0].'.php')){
				$routerconfig->controller = $array[0];
				unset($array[0]);
				if(isset($array[1]))
				{
					$routerconfig->action = $array[1];
					unset($array[1]);
				}
			} else{
				self::Error('404');
			}
		}		

		if(!isset($routerconfig->action))
			$routerconfig->action = JsonConfig::$_config['base']['router']['defaut_action'];

		$params = $_REQUEST;
		unset($params['url']);
		unset($params['PHPSESSID']);

		$routerconfig->params = $array ? array_values($array) + $params : $params;

		return $routerconfig;
	}

	public static function Error($type)
	{
		call_user_func_array(array(new Error(), 'error'.$type), []);
		exit();
	}

	public static function GetRoute()
	{
		return self::$_instance;
	}
}
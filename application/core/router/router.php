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
			require_once($instance['directory'].DS.$instance['controller'].'.php');
			if(class_exists("_".$instance['controller']))
			{
				$class_name = "_".$instance['controller'];
				$c = new $class_name;
			}
			else 
				$c = new $instance['controller'];
			if(method_exists($c, self::$_instance->action)){
				call_user_func_array(array($c, self::$_instance->action), self::$_instance->params);
			}
			else{
				self::$_instance->action = JsonConfig::$_config['base']['router']['defaut_action'];
				call_user_func_array(array($c, self::$_instance->action.'Action'), self::$_instance->params);
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
		$array = explode('/', filter_var($path=rtrim($path,'/')));
		foreach ($array as $key => $value) {
			if(is_dir($routerconfig->directory.DS.$value)){
				$routerconfig->directory .= DS.$value;
				unset($array[$key]);
			}
			else break;	
		}

		if(!file_exists($routerconfig->directory.DS.$routerconfig->controller.'.php')
			&& (isset($array[0]) && !file_exists($routerconfig->directory.DS.$array[0].'.php')))
		{
			$temp = explode(DS, $routerconfig->directory);
			$routerconfig->controller = end($temp);
			$routerconfig->directory = substr($routerconfig->directory, 0, strrpos($routerconfig->directory, DS));
		}

		$array = array_values($array);

		if(isset($array[0]) && $array[0] != ''){
			if(file_exists($routerconfig->directory.DS.$array[0].'.php')){
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
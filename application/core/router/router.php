<?php

require_once 'urlHelper.php';

class Router
{
	private static $_instance;

	public static function GetInstance()
	{
		if (!isset(self::$_instance)) {
			self::$_instance = self::Init();

		}
		return self::$_instance;
	}

	public static function Request()
	{
		if(isset(self::$_instance))
		{
			$instance = (array)(self::$_instance);
			
			if(file_exists($instance['directory'].DS.$instance['controller'].'.php'))
			{
				require_once($instance['directory'].DS.$instance['controller'].'.php');
				if(class_exists("_".$instance['controller']))
				{
					$class_name = "_".$instance['controller'];
					$c = new $class_name;
				}
				else $c = new $instance['controller'];

				if(method_exists($c, $instance['action'])){
					call_user_func_array(array($c, $instance['action']), $instance['params']);
				} 
				elseif(method_exists($c, $instance['action'].'Action')){
					call_user_func_array(array($c, $instance['action'].'Action'), $instance['params']);
				}
				else{
					self::Error('404', 'Action '.$instance['action'].' not found in controller '.$instance['controller'].'!');
				}
			}
			else 
			{
				self::Error('404', 'Controller '.$instance['controller'].' not found!');
			}
		}
		else{
			self::GetInstance();
			self::Request();
		}
	}

	// helper
	public static function Init()
	{
		$routerconfig = new RouterConfig();
		$routerconfig->params =  UrlHelper::GetParams();
		$array = UrlHelper::ExtractURL();
		$last_dir = null;
		foreach ($array as $key => $value) {
			if(is_dir($routerconfig->directory.DS.$value)){
				$last_dir = $value;
				$routerconfig->directory .= DS.$value;
				unset($array[$key]);
			}
			else break;	
		}
		$array = array_values($array);
		if(isset($array[0]))
		{
			$routerconfig->controller = $array[0];
			unset($array[0]);
		}
		else if(!file_exists($routerconfig->directory.DS.$routerconfig->controller.'.php')
			&& $last_dir 
			&& file_exists($routerconfig->directory.'.php'))
		{
			$routerconfig->controller = $last_dir;
			$routerconfig->directory = substr($routerconfig->directory, 0, strrpos($routerconfig->directory, DS));
		}

		$array = array_values($array);

		if(isset($array[0]))
		{
			$routerconfig->action = $array[0];
			unset($array[0]);
		}
		foreach ($array as $param) {
			array_push($routerconfig->params, $param);
		}
		return $routerconfig;
	}

	public static function Error($type, $message = '')
	{
		call_user_func_array(array(new Error(), 'error'.$type), [$message]);
		exit();
	}

	public static function GetRoute()
	{
		return self::$_instance;
	}
}

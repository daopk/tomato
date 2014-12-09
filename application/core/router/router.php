<?php

require_once 'urlHelper.php';

class Router
{
	private static $_instance = null;

	public static function GetInstance()
	{
		return self::$_instance;
	}

	public static function Request()
	{
		if(self::$_instance)
		{
			$instance = self::$_instance;

			if(file_exists(CTR_DIR.$instance->getDirectory().DS.$instance->getController().'.php'))
			{
				require_once(CTR_DIR.$instance->getDirectory().DS.$instance->getController().'.php');
				if(class_exists("_".$instance->getController()))
				{
					$class_name = "_".$instance->getController();
					$c = new $class_name;
				}
				else
				{
					$c_name = $instance->getController(); 
					$c = new $c_name;
				}

				if(method_exists($c, $instance->getAction())){
					call_user_func_array(array($c, $instance->getAction()), $instance->getParams());
				} 
				elseif(method_exists($c, $instance->getAction().'Action')){
					call_user_func_array(array($c, $instance->getAction().'Action'), $instance->getParams());
				}
				else{
					self::Error('404', 'Action '.$instance->getAction().' not found in controller '.$instance->getController().'!');
				}
			}
			else 
			{
				self::Error('404', 'Controller '.$instance->getController().' not found!');
			}
		}
		else{
			self::$_instance = self::Init();
			self::Request();
		}
	}

	// helper
	public static function Init()
	{
		$routerconfig = new RouterConfig();
		$routerconfig->setParams(UrlHelper::GetParams());
		$array = UrlHelper::ExtractURL();
		$last_dir = null;
		foreach ($array as $key => $value) {
			if(is_dir(CTR_DIR.$routerconfig->getDirectory().DS.$value)){
				$last_dir = $value;
				$routerconfig->addDirectory($value);
				unset($array[$key]);
			}
			else break;	
		}
		$array = array_values($array);
		if(isset($array[0]))
		{
			$routerconfig->setController($array[0]);
			unset($array[0]);
		}
		else if(!file_exists(CTR_DIR.$routerconfig->getDirectory().DS.$routerconfig->getController().'.php')
			&& $last_dir 
			&& file_exists(CTR_DIR.$routerconfig->getDirectory().'.php'))
		{
			$routerconfig->setController($last_dir);
			$routerconfig->setDirectory(substr($routerconfig->getDirectory(), 0, 
				strrpos($routerconfig->getDirectory(), DS)));
		}

		$array = array_values($array);

		if(isset($array[0]))
		{
			$routerconfig->setAction($array[0]);
			unset($array[0]);
		}
		foreach ($array as $param) {
			$routerconfig->addParams($param);
		}
		return $routerconfig;
	}

	public static function Error($type, $message = '')
	{
		call_user_func_array(array(new Error(), 'error'.$type), [$message]);
		exit();
	}
}
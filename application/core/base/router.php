<?php

/**
* 
*/
class TM_Router
{
	//
	// Controller of current request
	//
	var $controller = '';

	//
	// Action of current request
	//
	var $action = '';

	//
	// Params of current request
	//
	var $params = array();

	//
	// Directory of controller file
	//
	var $directory = '';

	//
	// 
	//
	function __construct($config)
	{
		$this->config($config);
	}

	/**
	* Set default router config from config file
	*/
	private function get_default_config($json_config)
	{
		$config = array(
			'controller' => $json_config->router->default_controller,
			'action' => $json_config->router->default_action,
			'params' => array()
			);
		return $config;
	}

	/**
	*
	*/
	private function config($config)
	{
		$default_config = $this->get_default_config($config);
		$config = $this->get_config_request($default_config);
		
		$this->controller = $config['controller'];
		$this->action = $config['action'];
		$this->params = $config['params'];
	}

	private function get_config_request($config)
	{
		$url_fragments = $this->get_url_fragments();

		$url_fragments = $this->check_directory($url_fragments);

		if(!empty($url_fragments[0]))
		{
			$config['controller'] = $url_fragments[0];
			unset($url_fragments[0]);
			if(!empty($url_fragments[1]))
			{
				$config['action'] = $url_fragments[1];
				unset($url_fragments[1]);
				$config['params'] = array_values($url_fragments);
			}
		}
		$config['params']['_tm_'] = $this->get_url_params();
		return $config;
	}

	private function get_url_fragments()
	{
		if(isset($_REQUEST['url']))
		{
			$url = $_REQUEST['url'];
			$fragments = explode('/', $url);
			return $fragments;
		}
		return array();
	}

	private function get_url_params()
	{
		$request = $_REQUEST;
		if(isset($request['url']))
			unset($request['url']);
		return $request;
	}

	private function check_directory($url_fragments)
	{
		$controller_dir = APP_DIR.DS.'controllers'.DS;
		foreach ($url_fragments as $key => $value) {
			if(is_dir($controller_dir.$this->directory.$value)){
				$this->directory .= $value.DS;
				unset($url_fragments[$key]);
			}
			else break;
		}
		return array_values($url_fragments);
	}


	public function request()
	{
		$controller = null;
		if($this->check_request($controller))
		{
			$controller->setDirectory($this->directory);
			$params = (object)($this->params['_tm_']);
			$controller->params = $params;

			if(method_exists($controller, '_'.$this->action))
				call_user_func_array(array($controller, '_'.$this->action), $this->params);
			else call_user_func_array(array($controller, $this->action), $this->params);
		}
	}

	private function check_request(&$controller)
	{
		if(file_exists(APP_DIR.DS.'controllers'.DS.$this->directory.$this->controller.'.php'))
		{
			
			require_once APP_DIR.DS.'controllers'.DS.$this->directory.$this->controller.'.php';
			if (class_exists('_'.$this->controller)) {
				$c_name = '_'.$this->controller;
				$controller = new $c_name();
			}
			elseif (class_exists($this->controller)) {
				$controller = new $this->controller();
			} else { echo("Controller {$this->controller} not found!"); die();}

			if(!method_exists($controller, $this->action) && !method_exists($controller, '_'.$this->action))
			{
				echo "Not found action: ".$this->action.' in controller '.$this->controller;
				return false;
			}
			return true;
		}
		else
		{
			include_once APP_DIR.DS.'errors'.DS.'error.php';
			
			$c_name = '_'.$this->controller;
			$controller = new TM_Error();
			call_user_func_array(array($controller, 'Error404'), array("messas fdfge"));
			/*
			
			/*
			echo "Not found controller ".$this->controller;
			if($this->directory)
				echo ' in directory '. $this->directory;
			*/
			return false;
		}
	}
}
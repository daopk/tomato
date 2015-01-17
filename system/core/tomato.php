<?php

/**
* Tomato Class
*/
class TomatoApp
{
	protected $config;

	protected $router;

	private static $instance;

	private function __construct()
	{
		$this->InitRouter();
	}

	public static function GetInstance()
	{
		if(self::$instance == NULL)
			self::$instance = new TomatoApp();
		return self::$instance;
	}

	private function InitRouter()
	{
		$this->router = TM_Router::GetInstance();
		$this->config = Setting_TM_Helper::GetInstance()->LoadConfig('router');
	}


	public static function run()
	{
		if(self::GetInstance()->router == NULL)
		{
			self::GetInstance()->InitRouter();
		}
        self::$instance->router->Request();
	}
}
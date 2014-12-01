<?php

class Home extends TM_Controller
{
	public function indexAction()
	{
		$model = 'I am model';
		
		$this->view('index', $model); 
	}
	public function demoAction($template = 'default')
	{
		$this->template = $template;
		$this->view('demo', $template);
	}
}
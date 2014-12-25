<?php

/**
* 	
*/
class Demo extends TM_Controller
{
	public function index()
	{
		if(isset($this->params->sky))
			$this->template = 'sky';
		$this->view('index');
	}
}
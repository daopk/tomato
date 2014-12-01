<?php

/**
* 
*/
class Error extends TM_Controller
{
	public function error404()
	{
		$this->view("404");
	}
}
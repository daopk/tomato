<?php

/**
* 
*/
class Error extends Controller
{
	public function error404()
	{
		$this->view("404");
	}
}
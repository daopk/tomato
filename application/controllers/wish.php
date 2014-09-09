<?php

/**
	* 
	*/
class Wish extends Controller
{	
	public function index()
	{
		$this->view('index');
	}	

	public function demo($message)
	{
		$handle = fopen("resource.txt", "a");
		fwrite($handle,"$message\n");
		fclose($handle);
	}
}

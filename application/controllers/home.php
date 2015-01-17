<?php

/**
* Home Controller
*/
class Home extends TM_Controller
{
	public function index()
	{
		$user = 'Phan Khắc Đạo';
		$this->view('index', $user);
	}
}
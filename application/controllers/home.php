<?php

/**
* Home Controller
*/
class Home extends TM_Controller
{
	public function index()
	{
		$user = $this->load->model('item');
		foreach ($user->getlist() as $key => $value) {
			dump($value['fullname']);
		}
		$this->view('index');
	}
}
<?php

class Home extends Controller
{
	public function index()
	{
		$model = 'I am model';
		
		$this->view('index', $model); 
	}

	public function hello($name = 'Tomato')
	{
		echo 'Hello '.$name;
	}

	public function add($a = 0, $b = 0){
		echo $a + $b;
	}

	public function mypet()
	{
		$mypet = new Pet('Kiwi');
		$mypet->showName();
	}
}
<?php

/**
* 
*/
class Item extends TM_Controller
{
	public function index()
	{
		if(isset($this->params->sky))
			$this->template = 'sky';
		$item = $this->load->model('item');
		$model = $item->getList();
		$this->view('index', $model);
	}

	public function detail($name)
	{
		$dao = $this->load->model('item');
		echo $dao->getValue($name);
	}
}
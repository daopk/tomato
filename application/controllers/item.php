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
		$model = $this->db->item()->select('*');
		$this->view('index', $model);
	}
}
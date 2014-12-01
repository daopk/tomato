<?php

/**
* 
*/
class Item extends TM_Controller
{
	public function index(){
		global $db;
		
		$items = $db->item()->select('name');

		$this->view('index', $items);
	}
}
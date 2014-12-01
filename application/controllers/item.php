<?php

/**
* 
*/
class Item extends TM_Controller
{
	public function indexAction(){
		global $db;
		
		$items = $db->item()->select('name');

		$this->view('index', $items);
	}
}
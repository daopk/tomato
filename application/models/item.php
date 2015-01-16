<?php

/**
* Item model
*/
class Item_M extends TM_Model
{
	public function getlist()
	{
		$users = $this->db->user()->select('*');
		return iterator_to_array($users);
	}
}
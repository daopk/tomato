<?php

/**
* 							
*/
class Item_M extends TM_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function getList()
	{
		return $this->db->items()->select('*');
	}

	public function getValue($name)
	{
		return $this->db->items()->select('value')->where('name', $name)->fetch()['value'];
	}
}

?>
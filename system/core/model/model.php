<?php

/**
* Model
*/
class TM_Model
{
	protected $db;
	function __construct()
	{
		$this->db = Database_TM_Helper::GetDatabase();
	}
}
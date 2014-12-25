<?php

/**
* 
*/
class TM_Library
{
	function __construct()
	{
		
	}

	public function Load($lib_name)
	{
		require_once CORE_DIR.DS.'libraries'.DS.$lib_name.'.php';
	}
}
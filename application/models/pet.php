<?php

/**
* 
*/
class Pet
{
	var $name;
	function __construct($name)
	{
		$this->name = $name;
	}

	public function showName()
	{
		echo "My name is ".$this->name;
	}
}
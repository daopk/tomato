<?php

session_start();

/**
* 
*/
class Session
{
	
	public static function read($name)
	{
		if(isset($_SESSION[$name]))
			return $_SESSION[$name];
		return null;
	}

	public static function write($name, $value)
	{
		$_SESSION[$name] = $value;
	}

	public static function delete($name)
	{
		if(isset($_SESSION[$name]))
			unset($_SESSION[$name]);
	}
}
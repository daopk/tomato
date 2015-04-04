<?php

/**
* Session helper 
*/
class Session_TM_Helper{

	public static function write($key, $data)
	{
		$_SESSION[$key] = $data;
	}

	public static function read($key)
	{
		if(isset($_SESSION[$key]))
			return $_SESSION[$key];
		return null;
	}

	public static function delete($key)
	{
		if(isset($_SESSION[$key]))
			$_SESSION[$key] = null;
	}

	public static function destroy()
	{
		session_destroy();
	}
}
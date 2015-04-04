<?php

/**
* String helper 
*/
class String_TM_Helper{

	public static function random($n = 5)
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randstring = '';
		for ($i = 0; $i < $n; $i++) {
			$randstring .= $characters[rand(0, strlen($characters)-1)];
		}
		return $randstring;
	}

	public static function randomNumber($n = 5)
	{
		$numbers = '123456789';
		$randstring = '';
		for ($i = 0; $i < $n; $i++) {
			$randstring .= $numbers[rand(0, strlen($numbers)-1)];
		}
		return $randstring;	
	}
}
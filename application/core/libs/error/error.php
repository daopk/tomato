<?php

/**
* 
*/
class TM_Error
{
	public static function show($type, $message)
	{
		call_user_func_array(array(new Error(), 'error'.$type), [$message]);
		exit();
	}
}
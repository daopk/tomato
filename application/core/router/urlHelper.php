<?php

/**
* 
*/
class UrlHelper
{
	public static function ExtractURL()
	{
		$array = [];
		if(isset($_REQUEST['url']))
		{
			$url = $_REQUEST['url'];
			$array = explode('/', filter_var($url=rtrim($url,'/')));
		}
		return $array;
	}

	public static function GetParams()
	{
		$prams = $_REQUEST;
		unset($prams['url']);
		return $prams;
	}
}
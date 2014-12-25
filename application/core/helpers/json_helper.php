<?php

/**
* 
*/
class Json_Helper
{
	public function load($json_path)
	{
		if(file_exists($json_path))
		{
			$json = file_get_contents($json_path);
			return json_decode($json);
		}
		return null;
	}

	public function save($json_path, $array)
	{
		$json = json_encode($array);
		file_put_contents($json_path, $json);
	}
}
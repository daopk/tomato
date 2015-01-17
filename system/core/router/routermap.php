<?php

/**
* Router Mapping
*/
class RouterMap
{
	private static $routers = array();

	public static function AddRoute($url,array $default)
	{
		self::$routers[] = array(
			'url' => $url,
			'default' => $default
			);
	}

	public static function MappingRoute($url)
	{
		$begin = strpos($url, 'index.php');
		if($begin != false)
			$url = substr($url, $begin + 9);
		$url = trim($url, '/');		
		
		foreach (self::$routers as $router) {
			$result = self::CheckRoute($url, $router['url']);
			if($result !== false)
			{
				foreach ($router['default'] as $key => $value) {
					if(!isset($result[$key]) || empty($result[$key]))
						$result[$key] = $value;
				}
				break;
			}
		}
		if(empty($result['directory']) || $result['directory'] === DS)
			$result['directory'] = '';

		return $result;
	}

	private static function CheckRoute($url, $map)
	{
		$routeDebug = false;

		$matchMap = self::CheckPrefix($url, $map);
		if($matchMap === false)
			return false;

		$variables = explode('}', $map);
		$delimiters = array();
		$values = array();

		foreach ($variables as $key => $value) {
			if(!empty($value))
			{
				$pos = strpos($value, '{');
				if($pos > 0)
				{
					$delimiters[] = substr($value, 0, $pos);
				}
				$new = substr($value, $pos + 1);
				$variables[$key] = $new;
			}
			else unset($variables[$key]);
		}

		if($routeDebug)
		{
			echo "Variables: ";
			dump($variables);
			echo "Delimiters: ";
			dump($delimiters);
		}
		
		$var_dir_index = array_search('directory', $variables);
		$key = 0;
		
		while ($key < sizeof($delimiters)) {
			
			$delimiter = $delimiters[$key];

			if($routeDebug)
			{
				dump("Split url with delimiters[$key]: ".$delimiter);
			}

			if(strpos($url, $delimiter) === false)
			{
				if($routeDebug)
				{
					dump("Exit split url because Not found $delimiter in $url");
				}
				break;
			}
			
			if($key === $var_dir_index)
			{
				if($routeDebug)
				{
					dump("Check url: $url");
				}

				$values[] = self::CheckDir($url, $delimiters[$key]);
				if($routeDebug)
					dump("Set directory: ".end($values));
			}
			else{
				if($routeDebug)
					dump("Set value: ".substr($url, 0, strpos($url, $delimiter)));
				$values[] = substr($url, 0, strpos($url, $delimiter));
				$url = substr($url, strpos($url, $delimiter) + strlen($delimiter));
			}
			$key++;
		}


		if($routeDebug)
			dump("URL: $url");

		$result = array();

		if($key === $var_dir_index)
		{
			if($routeDebug)
				dump("Cần kiểm tra directory trước cho url $url");
			$values[] = self::CheckDir($url);
		}
		
		if($routeDebug)
		{
			dump("Key : $key");
			dump('var_dir_index: '.$var_dir_index);
			dump('url: '.$url);
		}

		$result['params'] = explode('/', $url);
		


		if($key <= sizeof($variables) - 1)
		{
			$values[] = array_shift($result['params']);
		}

		foreach ($variables as $key => $value) {
			if(isset($values[$key]))
				$result[$value] = $values[$key];
		}
		return $result;
	}

	private static function CheckDir(&$url, $delimiter = null)
	{
		$directory = TOMATO_DIR_APP_CTRL;
		while (strpos($url, '/') !== false) {
			$pos = strpos($url, '/');
			$dirname = substr($url, 0, $pos);
			if(!empty($delimiter) && strpos($dirname, $delimiter) !== false)
			{
				$dirname = substr($dirname, 0 , strpos($dirname, $delimiter));
			}
		//	if(Directory_TM_Helper::HasFolder($dirname,TOMATO_DIR_APP_CTRL.$directory))
			if(Directory_TM_Helper::HasFolder($dirname,$directory))
			{
				$directory .= $dirname.DS;
				$url = substr($url, $pos + 1);
			} else return $directory;
		}
		if(!empty($delimiter))
			$end = strpos($url, $delimiter);

		if(empty($end) || $end === false) $end = strlen($url);

		//if(Directory_TM_Helper::HasFolder(substr($url,0, $end),TOMATO_DIR_APP_CTRL.$directory))
		if(Directory_TM_Helper::HasFolder(substr($url,0, $end),$directory))
		{
			if(substr($url,0, $end))
				$directory .= substr($url,0, $end).DS;
			$url = substr($url,$end + strlen($delimiter));
		}
		return $directory;
	}

	private static function CheckPrefix(&$url, &$map)
	{
		$beginMap = strpos($map, '{');
		$prefixMap = substr($map, 0, $beginMap);

		if(!empty($prefixMap))
		{
			if(strpos($url, $prefixMap) !== 0){
				return false;
			}
			else {
				$url = substr($url, strlen($prefixMap));
				$map = substr($map, strlen($prefixMap));
			}
		}
		return true;
	}
}
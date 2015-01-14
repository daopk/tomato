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
				if(!isset($result['controller']) || empty($result['controller']))
					$result['controller'] = $router['default']['controller'];
				if(!isset($result['action']) || empty($result['action']))
					$result['action'] = $router['default']['action'];
				break;
			}
		}
		return $result;
	}

	private static function CheckRoute($url, $map)
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

		foreach ($delimiters as $delimiter) {
			if(strpos($url, $delimiter) === false)
				break;
			$values[] = substr($url, 0, strpos($url, $delimiter));
			$url = substr($url, strpos($url, $delimiter) + strlen($delimiter));
		}
		$result = array();

		if(strpos($url, '/') != false)
		{
			$result['params'] = explode('/', $url);
			$values[] = array_shift($result['params']);
		}
		else $values[] = $url;
		
		foreach ($variables as $key => $value) {
			if(isset($values[$key]))
				$result[$value] = $values[$key];
		}
		return $result;
	}
}
<?php

/**
* 
*/
class Template
{
	public static $view;
	public static $name;
	public static $styles = array();
	public static $scripts = array();

	public static function RenderBody()
	{
		require_once(self::$view->pathView);
	}

	//
	// STYLE
	//

	public static function RenderStyle($style_name = '')
	{
		if($style_name == '')
		{
			foreach (self::$styles as $arrayStyle) {
				if(is_array($arrayStyle))
					foreach ($arrayStyle as $style) {
						self::EchoStyle($style);
					}
				else self::EchoStyle($style);
			}
		}
		else {
			$styles = self::$styles[$style_name];	
				foreach ($styles as $style) {
						self::EchoStyle($style);
			}	
		}		
	}

	public static function AddStyle($styles)
	{
		self::$styles += $styles;
	}


	public static function EchoStyle($name)
	{
		echo'<link rel="stylesheet" type="text/css" href="'.BASE_URL.'asset/css/'.$name.'" media="screen">
		';
	}

	//
	// SCRIPT
	//

	public static function RenderScript($script_name = '')
	{
		if($script_name == '')
		{
			foreach (self::$scripts as $arrayScript) {
				if(is_array($arrayScript))
					foreach ($arrayScript as $script) {
						self::EchoScript($script);
					}
				else self::EchoScript($script);
			}
		}
		else {
			$scripts = self::$scripts[$script_name];
				foreach ($scripts as $script) {
				self::EchoScript($script);
			}	
		}		
	}

	public static function AddScript($scripts)
	{
		self::$scripts += $scripts;
	}


	public static function EchoScript($name)
	{
		echo '<script type="text/javascript" src="'.BASE_URL.'asset/js/'.$name.'"></script>
		';
	}

	public static function ActionLink($text, $controller='', $action='', $classes = '')
	{
		$link = BASE_URL;
		if($controller)
		{
			$link .= $controller;
			if($action)
				$link .= '/'.$action;
		}
		echo '<a href="'.$link.'"';
		if($classes != '')
			echo ' class="'.$classes.'"';
		echo '>'.$text.'</a>
		';
	}
}
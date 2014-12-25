<?php

/**
* 
*/
class TM_Template
{
	var $name;
	var $path_view;
	var $styles = array();
	var $scripts = array();
	var $model;

	function __construct($name, $model)
	{
		$this->name = &$name;
		$this->model = &$model;
		if (file_exists(APP_DIR.DS.'template'.DS.$this->name.DS.'config.php')) {
			include_once APP_DIR.DS.'template'.DS.$this->name.DS.'config.php';
		}
	}

	function render($path)
	{
		$this->path_view = $path;
		$model = &$this->model;
		if(file_exists(APP_DIR.DS.'template'.DS.$this->name.DS.'index.php'))
			include_once APP_DIR.DS.'template'.DS.$this->name.DS.'index.php';
		else echo "Template `$this->name` not found!";		
	}

	public function RenderBody()
	{
		$model = &$this->model;
		if(file_exists(APP_DIR.DS.'views'.DS.$this->path_view))
			include APP_DIR.DS.'views'.DS.$this->path_view;
		elseif(file_exists(APP_DIR.DS.'errors'.DS.$this->path_view))
			include APP_DIR.DS.'errors'.DS.$this->path_view;
		else echo "Error: Not found - $this->path_view";
	}

	public function AddScript($script)
	{
		$this->scripts += $script;
	}

	public function AddStyle($style)
	{
		$this->styles += $style;
	}

	public function RenderStyle($style_name = '')
	{
		if (empty($style_name)) {
			foreach ($this->styles as $key => $style) {
				foreach ($style as $name) {
					$this->EchoStyle($name);
				}
			}
		} else foreach ($this->styles[$style_name] as $name) {
			$this->EchoStyle($name);
		}
	}

	public function RenderScript($script_name = '')
	{
		if (empty($script_name)) {
			foreach ($this->scripts as $key => $script) {
				foreach ($script as $name) {
					$this->EchoScript($name);
				}
			}
		} else foreach ($this->scripts[$script_name] as $name) {
			$this->EchoScript($name);
		}
	}

	public function EchoStyle($style)
	{
		if (file_exists(PUBLIC_DIR.DS.'assets'.DS.'css'.DS.$style)) {
			echo'<link rel="stylesheet" type="text/css" href="'._Tomato::$config->base_url.'assets/css/'.$style.'" media="screen">
			';
		}
	}

	public function EchoScript($script)
	{
		if (file_exists(PUBLIC_DIR.DS.'assets'.DS.'js'.DS.$script)) {
			echo '<script type="text/javascript" src="'._Tomato::$config->base_url.'assets/js/'.$script.'"></script>
			';
		}
	}

	public function Link($text, $link = '' , $classes = '')
	{
		echo '<a href="'._Tomato::$config->base_url.$link;
		if(!empty($classes))
			echo '" class="'.$classes;
		echo '" >'.$text.'</a>';
	}
}
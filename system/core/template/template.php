<?php

class TM_Template{
	protected $model, $viewPath, $template_name;
	private $styles = array(), $scripts = array();
	private static $rendered = false;

	function __construct($viewPath, $template, &$model = null)
	{
		$this->viewPath = $viewPath;
		$this->model = $model;
		$this->template_name = $template;
		if(file_exists(TOMATO_DIR_THEME.$this->template_name.DS.'config.php'))
			require_once TOMATO_DIR_THEME.$this->template_name.DS.'config.php';
	}

	public function Render()
	{
		if(!self::$rendered)
		{
			self::$rendered = true;
			$model = &$this->model;
			if(file_exists(TOMATO_DIR_THEME.$this->template_name.DS.'config.php'))
				require_once TOMATO_DIR_THEME.$this->template_name.DS.'index.php';
			else throw new Exception("Missing index file for template `$this->template_name`", 1);			
		} else throw new Exception("Can't call Render method!", 1);
		
	}

	protected function RenderBody()
	{
		if(file_exists($this->viewPath))
		{
			$model = &$this->model;
			include $this->viewPath;
		}
		else throw new Exception("Can't find path view {$this->pathView}", 1);	
	}

	protected function AddStyle($styles)
	{
		if(is_array($styles)){
			foreach ($styles as $key => $style){
				foreach ($style as $value) {
					$this->styles[$key][] = $value;	
				}				
			}
		}
		else $this->styles[''][] = $styles;
	}

	protected function AddScript($scripts)
	{
		if(is_array($scripts)){
			foreach ($scripts as $key => $script){
				foreach ($script as $value) {
					$this->scripts[$key][] = $value;
				}
			}
		}
		else $this->scripts[''][] = $scripts;
	}

	protected function RenderStyle($key = '')
	{
		if($key == '')
		{
			foreach ($this->styles as $key => $styles) {
				foreach ($styles as $key => $style) {
					$this->EchoStyle($style);
				}
			}
		} else if(isset($this->styles[$key])) {
			foreach ($this->styles[$key] as $style) {
				$this->EchoStyle($style);
			} 
		}
	}

	protected function RenderScript($key = '')
	{
		if($key == '')
		{
			foreach ($this->scripts as $key => $scripts) {
				foreach ($scripts as $key => $script) {
					$this->EchoScript($script);
				}				
			}
		} else {
			foreach ($this->scripts[$key] as $script) {
				$this->EchoScript($script);
			} 
		}
	}

	public function EchoStyle($style)
	{
		if (file_exists(TOMATO_DIR_ASSET.'css'.DS.$style)) {
			echo'<link rel="stylesheet" type="text/css" href="'.BASE_URL.'asset/css/'.$style.'" media="screen">
			';
		}
	}

	public function EchoScript($script)
	{
		if (file_exists(TOMATO_DIR_ASSET.'js'.DS.$script)) {
			echo '<script type="text/javascript" src="'.BASE_URL.'asset/js/'.$script.'"></script>
			';
		}
	}
}
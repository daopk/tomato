<?php

/**
* Template
*/
class Template_TM_Module
{
    protected $model, $viewPath, $viewName, $template_name;
    protected $currentPage, $totalPage;
    protected $route;
    protected $db;

    private $scripts = array();
    private $styles = array();

    private static $rendered = false;

    function __construct()
    {
        if(file_exists(TOMATO_DIR_APP_CONFIG.'database.php'))
        {
            $dbConfig = include TOMATO_DIR_APP_CONFIG.'database.php';
            $this->db = Load_TM_Helper::module('database')->GetDB();
        }
    }

    function Set($viewPath, $viewName, $route, &$model = null)
    {
        $this->viewPath = $viewPath;
        $this->viewName = $viewName;
        $this->model = $model;
        $this->route = $route;
        $this->template_name = $route['template'];
        if(file_exists(TOMATO_DIR_TEMPLATE.$this->template_name.DS.'config.php'))
            require_once TOMATO_DIR_TEMPLATE.$this->template_name.DS.'config.php';
    }

    function setPage($page, $total)
    {
        $this->currentPage = $page;
        $this->totalPage = $total;
    }

    public function Render()
    {
        if(!self::$rendered)
        {
            self::$rendered = true;
            $model = &$this->model;
            if(file_exists(TOMATO_DIR_TEMPLATE.$this->template_name.DS.'config.php'))
                require_once TOMATO_DIR_TEMPLATE.$this->template_name.DS.'index.php';
            else throw new Exception("Missing index file for template `$this->template_name`", 1);
        } else throw new Exception("Can't call Render method!", 1);
    }

    protected function RenderBody()
    {

        if(file_exists($this->viewPath))
        {
            $model = &$this->model;
            include $this->viewPath.$this->viewName.'.php';
        }
        else throw new Exception("Can't find path view {$this->viewPath}", 1);
    }

    protected function RenderLayout($path, $using_base = true)
    {
        if($using_base)
            require TOMATO_DIR_APP_VIEW.$path.'.php';
        else require $path.'.php';
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
            echo'<link rel="stylesheet" type="text/css" href="'.BASE_URL.'assets/css/'.$style.'" media="screen">
            ';
        }
    }

    public function EchoScript($script)
    {
        if (file_exists(TOMATO_DIR_ASSET.'js'.DS.$script)) {
            echo '<script type="text/javascript" src="'.BASE_URL.'assets/js/'.$script.'"></script>
            ';
        }
    }

    public function RenderPagination()
    {
        $url = BASE_URL.ltrim($_SERVER['REQUEST_URI'], '/');
        $url = str_replace('&page='.$this->currentPage, '', $url);
        $url = str_replace('?page='.$this->currentPage, '', $url);
        if(strpos($url, '?'))
            $url .= '&';
        else $url .= '?';
        echo '<ul class="pagination pull-right">';
        if($this->currentPage > 1)
            echo '<li aria-hidden="true"><a href="'.$url.'page='.($this->currentPage - 1).'">&laquo;</a></li>';
        else echo '<li aria-hidden="true" class="disabled"><a href="">&laquo;</a></li>';

        for ($i=$this->currentPage - 3; $i <= $this->currentPage + 3; $i++) {
            if ($i > 0 && $i <= $this->totalPage) {
                echo '<li';
                if($i == $this->currentPage)
                    echo ' class="active"';
                echo '><a href="'.$url.'page='.$i.'">'.$i.'</a></li>';
            }
        }
        if($this->currentPage < $this->totalPage)
            echo '<li aria-hidden="true"><a href="'.$url.'page='.($this->currentPage + 1).'">&raquo;</a></li></ul>';
        else echo '<li class="disabled" aria-hidden="true"><a href="">&raquo;</a></li></ul>';
    }
}
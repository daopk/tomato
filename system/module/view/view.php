<?php

/**
*
*/
class View_TM_Module
{
    protected $view_name, $route, $model;
    protected $currentPage, $totalPage;

    function __construct()
    {
        //
    }

    function set($view_name, $route, $model)
    {
        $this->view_name = $view_name;
        $this->route = $route;
        $this->model = $model;
    }

    function setPage($page, $total)
    {
        $this->currentPage = $page;
        $this->totalPage = $total;
    }

    function Render($direct = false)
    {
        $template = Load_TM_Helper::module('template');
        if($direct)
            $view_path = TOMATO_DIR_APP_VIEW;
        else
            $view_path = TOMATO_DIR_APP_VIEW.$this->route['directory'].$this->route['controller'].DS;
        $template->set($view_path, $this->view_name, $this->route, $this->model);
        $template->setPage($this->currentPage, $this->totalPage);
        $template->Render();
    }
}
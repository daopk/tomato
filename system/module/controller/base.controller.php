<?php

/**
* 
*/
class TM_Controller
{
	public $db, $load;
	private $route;

	public $page, $limit, $pageTotal;

	function __construct()
	{
		$this->db = Load_TM_Helper::module('database')->GetDB();
		$this->load = new Load_TM_Helper();
	}

	function ApplyRole(array $roles)
	{
		$session = Session_TM_Helper::read('user');
		if (!in_array($session['role'], $roles)) {
			header('Location: '.BASE_URL);
			die();
		}
	}

	function OnlyPost()
	{
		header('Content-type: application/json; charset=utf-8');
		if(empty($_POST))
		{
			echo json_encode(['status'=>false, 'message' => 'POST Only']);
			die();
		}
	}

	function SetRoute($route)
	{
		$this->route = $route;
		extract($this->route);
	}

	function SetTemplate($template)
	{
		$this->route['template'] = $template;
	}

	function view($view_name, $model = null)
	{
		$view = Load_TM_Helper::module('view');
		$view->set($view_name, $this->route, $model);
		$view->setPage($this->page, $this->pageTotal);
		$view->render();
	}

	function directView($viewname, $model = null)
	{
		$view = Load_TM_Helper::module('view');
		$view->set($viewname, $this->route, $model);
		$view->setPage($this->page, $this->pageTotal);
		$view->render(true);
	}

	function checkPage($limit = 10)
	{
		$this->page = 1; 
		$this->limit = $limit;
		if(isset($_GET['page']) && intval($_GET['page']) > 0)
			$this->page = intval($_GET['page']);
		if(isset($_GET['limit']) && intval($_GET['limit']) > 0)
			$this->limit = intval($_GET['limit']);
	}
}
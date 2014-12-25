<?php

/**
* This class load the necessary files of core framework
* Includes the base class of Controller, View, Model, Helpers, Libraries
*/
class _bootstrapTomato
{
	/**
	 * [__construct description]
	 */
	function __construct()
	{
		$this->load_base_class();
		$this->load_libraries();
		$this->load_helpers();
	}

	/**
	 * [load_base_class description]
	 * @return [type] [description]
	 */
	private function load_base_class()
	{
		require_once CORE_DIR.DS.'base'.DS.'controller.php';
		require_once CORE_DIR.DS.'base'.DS.'template.php';
		require_once CORE_DIR.DS.'base'.DS.'view.php';
		require_once CORE_DIR.DS.'base'.DS.'model.php';
		require_once CORE_DIR.DS.'base'.DS.'helper.php';
		require_once CORE_DIR.DS.'base'.DS.'library.php';
		require_once CORE_DIR.DS.'base'.DS.'router.php';
		require_once CORE_DIR.DS.'tomato.php';
	}
	
	/**
	 * [load_helpers description]
	 * @return [type] [description]
	 */
	private function load_helpers()
	{
		//require_once CORE_DIR.DS.'helpers'.DS.'json_helper.php';
	}

	/**
	 * [load_libraries description]
	 * @return [type] [description]
	 */
	private function load_libraries()
	{
		require_once CORE_DIR.DS.'libraries'.DS.'database'.DS.'NotORM.php';
	}
}

new _bootstrapTomato();
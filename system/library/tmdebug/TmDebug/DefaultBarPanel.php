<?php

/**
 * This file is part of the Tomato Debug (https://github.com/daofresh/tomato)
 */

namespace TmDebug;

use TmDebug;


/**
 * IBarPanel implementation helper.
 *
 * @author     David Grudl
 * @internal
 */
class DefaultBarPanel implements IBarPanel
{
	private $id;

	public $data;


	public function __construct($id)
	{
		$this->id = $id;
	}


	/**
	 * Renders HTML code for custom tab.
	 * @return string
	 */
	public function getTab()
	{
		ob_start();
		$data = $this->data;
		require __DIR__ . "/templates/bar.{$this->id}.tab.phtml";
		return ob_get_clean();
	}


	/**
	 * Renders HTML code for custom panel.
	 * @return string
	 */
	public function getPanel()
	{
		ob_start();
		if (is_file(__DIR__ . "/templates/bar.{$this->id}.panel.phtml")) {
			$data = $this->data;
			require __DIR__ . "/templates/bar.{$this->id}.panel.phtml";
		}
		return ob_get_clean();
	}

}

<?php

/**
 * This file is part of the Tomato Debug (https://github.com/daofresh/tomato)
 */

namespace TmDebug;

use TmDebug;


/**
 * Custom output for Debugger.
 *
 * @author     David Grudl
 */
interface IBarPanel
{

	/**
	 * Renders HTML code for custom tab.
	 * @return string
	 */
	function getTab();

	/**
	 * Renders HTML code for custom panel.
	 * @return string
	 */
	function getPanel();

}

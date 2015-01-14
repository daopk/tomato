<?php

/**
 * This file is part of the tomato (http://tomato.nette.org)
 */

if (!function_exists('dump')) {
	/**
	 * tomato\Debugger::dump() shortcut.
	 * @tomatoSkipLocation
	 */
	function dump($var)
	{
		foreach (func_get_args() as $arg) {
			TmDebug\Debugger::dump($arg);
		}
		return $var;
	}
}

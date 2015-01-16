<?php

/**
* Directory helper
*/
class Directory_TM_Helper
{
	public static function HasFolder($folder, $parent)
	{
		$parent = rtrim($parent);
		return is_dir($parent.DS.$folder);
	}
}
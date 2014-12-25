<?php

/**
* 
*/
class TM_Error extends TM_Controller
{
	public function Error404($message)
	{
		$this->ShowError('404', $message);
	}
}
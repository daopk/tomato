<?php 

class DatabaseException extends Exception
{
	var $message = '';
	public function __construct( $message)
	{
		parent::__construct( $message);
		$this->message = $message;
	}
}
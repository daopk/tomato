<?php

/**
* 
*/
class Database
{
    private static $_link;
    private static $rows = array();
	
	function __construct($config)
	{
		if(!self::$_link)
			self::Connect();
	}

	private static function Connect()
	{
		$_configuration = Jsonconfig::$_config['database'];
	
		self::$_link = new mysqli($_configuration['host'], $_configuration['username'], 
		 	$_configuration['password'], $_configuration['name']);
		
		mysqli_query(self::$_link, "SET NAMES utf8");
		
         if (!self::$_link)
             throw new DatabaseException("Failed to connect to MySQL Database");
	}

	public static function Query($query)
	{
		self::$rows = array();

		$result = mysqli_query(self::$_link, $query); 

		if(isset($result->num_rows))
		{
			$num_rows = $result->num_rows;
 			while ($row =  mysqli_fetch_assoc($result)) {
 				self::$rows[] = $row;
    		}
				
			return self::$rows;
		}
	}

	public static function MultiQuery($query)
	{
		echo($query);
		mysqli_multi_query(self::$_link, $query);
	}

	public static function Rows()
	{
		return self::$rows;
	}

	public static function last_insert_id()
	{
		return mysqli_insert_id(self::$_link);
	}
}
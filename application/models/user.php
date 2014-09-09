<?php


/**
* 
*/
class User
{
	public static $id;
	public static $friendid;

	public static function login($name)
	{
		$ip = '';
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
		    $ip = $_SERVER['REMOTE_ADDR'];
		}
		
		Database::query("INSERT INTO user (name, ip) VALUES ('$name', '$ip')");
		
		User::$id = $id = Database::last_insert_id();
		Session::write('userid', $id);
	}

	public static function isexist($userid)
	{
		Database::query("SELECT * FROM user WHERE id = $userid");
		if(is_null(Database::Rows()))
			return false;
		return true;
	}

	public static function hasfriend($userid)
	{
		Database::query("SELECT idfriend FROM user WHERE id = $userid");
		if(is_null(Database::Rows()))
			return -1;
		return Database::Rows();
	}

	public static function listfree()
	{
		$data = Database::query("SELECT id FROM user WHERE idfriend = 0 AND id <> ".Session::read('userid'));
		$result = array();
		while($row = each($data)[1]['id'])
			$result[] = $row;
		return $result;
	}

	public static function logout()
	{
		Session::delete('userid');
	}

	public static function send($message)
	{
		$id = Session::read('userid');
		$friendid = Session::read('idfriend');

		Database::query("INSERT INTO message(sendid, receiveid, text) VALUES ('$id', '$friendid', N'$message')");
	}

	public static function getmessage($id, $friendid)
	{
		$data = Database::query("SELECT text, id FROM message WHERE sendid = '$friendid' AND receiveid = '$id' AND isread = 0");
		$lastms = end($data)['id'];

		Database::query("UPDATE message SET isread = 1 WHERE sendid = '$friendid' AND receiveid = '$id'  AND isread = 0 AND id <= '$lastms'");
		return json_encode($data);
	}

	public static function set_friend($friendid)
	{
		$id = Session::read('userid');

		$query = "UPDATE user SET idfriend = $friendid WHERE id = $id;";
		$query .= "UPDATE user SET idfriend = $id WHERE id = $friendid";
		
		Database::MultiQuery($query);
	}
}
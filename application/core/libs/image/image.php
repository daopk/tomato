<?php

/**
* 
*/
class Image
{
	public static function Upload($file)
	{
		$allowedExts = array("gif", "jpeg", "jpg", "png");
		$temp = explode(".", $file["name"]);
		$extension = end($temp);

		if ((($file["type"] == "image/gif")
		|| ($file["type"] == "image/jpeg")
		|| ($file["type"] == "image/jpg")
		|| ($file["type"] == "image/pjpeg")
		|| ($file["type"] == "image/x-png")
		|| ($file["type"] == "image/png"))
		&& ($file["size"] < 1024 * 1024 * 2)
		&& in_array($extension, $allowedExts)) {
		  if ($file["error"] > 0) {
		    echo "Error: " . $file["error"] . "<br>";
		  } else {
		  	move_uploaded_file($_FILES["file"]["tmp_name"],
      		"upload/" . $_FILES["file"]["name"]);
		  }
		} else {
		  echo "Invalid file";
		}
	}
}

?>
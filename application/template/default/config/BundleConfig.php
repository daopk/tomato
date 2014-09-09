<?php

// Template::AddStyle(array(
//     "foo" => array("a", "b", "c"),
//     "boo" => array("a", "b", "c"),
//     "bar" => "d",
// )); 

Template::AddStyle(array(
	"wishes" => array("font-awesome.min.css", "wishes.css")
    //"boo" => array("a", "b", "c"),
));

Template::AddScript(array(
	"jquery" => array("jquery-1.11.1.min.js"),
	"wishes" => array("animation.js", "wishes.js")
     //"boo" => array("a", "b", "c"),
));

?>
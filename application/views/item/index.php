<h4>List items: </h4>
<?php
	foreach (View::$model as $key => $value) {
		echo $key.': '.$value['name'].'<br />';
	}
?>
<hr />
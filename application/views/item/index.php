<div class="wrapper">
<h4>List items: </h4>
<?php
	foreach (View::$model as $key => $value) {
		echo $key.': '.$value['name'].'<br />';
	}
?>


<hr>
<pre>
		class Item extends Controller
		{
			public function index(){
				global $db;
				
				$items = $db->item()->select('name');

				$this->view('index', $items);
			}
		}
</pre>

</div>
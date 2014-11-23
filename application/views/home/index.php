<div class="wrapper">
	<h3>WELCOME TO TOMATO FRAMEWORK</h3>
	<p>Easy way to create your website by PHP with software architectural pattern MVC</p>
	<p>Model : <?= View::$model ?></p>
	<hr>
	<p>Code:</p>
	<pre>
		public function index()
		{
			$model = 'I am model';
			
			$this->view('index', $model); 
		}</pre>
</div>

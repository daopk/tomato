<div class="wrapper">
	<h1>TOMATO FRAMEWORK</h1>
	<?php if(View::$model == 'sky'){ ?>
		<h3>Template: Sky</h3>
	<?php } ?>

	<h3>Controller: Home</h3>
	<h3>Action: Demo</h3>



	<a href="<?= BASE_URL ?>" title="">Back To Index</a>

	<?php if(View::$model != 'sky'){ ?>
	<hr>
	<pre>
	public function demo($template = 'default')
	{
		$this->template = $template;
		$this->view('demo', $template);
	}	</pre>
	<?php } ?>
</div>

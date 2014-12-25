<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
	<?php $this->RenderStyle() ?>
</head>
<body>
	<header class="main-header">
		<div class="logo">
			<h1>Tomato</h1>
			<h5>with Sky</h5>
		</div>		
		<nav class="main-menu">
			<?php $this->Link('Home', '?sky') ?>
			<?php $this->Link('Demo Page', 'demo?sky') ?>
			<?php $this->Link('Items', 'item?sky') ?>
			<?php $this->Link('Default Template') ?>
		</nav>
	</header>
	<div class="wrapper">
		<div class="main-content">
		<?php 
			$this->RenderBody() 
		?>
		</div>	
		<footer class="main-footer">
			Build on Tomato Framework
		</footer>
	</div>
	<?php
	$this->RenderScript();
	?>
</body>
</html>
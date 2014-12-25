<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Tomato</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
	<?php $this->RenderStyle(); ?>
</head>
<body>
	<header id="header" class="">
		<?php $this->Link('<div class="logo"><h1>TOMATO</h1></div>') ?>
		<div class="top-menu">
			<nav>
				<ul>
					<li><?php $this->Link('Home') ?></li>
					<li><?php $this->Link('Demo page', 'demo') ?></li>
					<li><?php $this->Link('Items', 'item') ?></li>
					<li><?php $this->Link('Sky template', '?sky') ?></li>
				</ul>
			</nav>
		</div>
	</header><!-- /header -->
	<div class="main-body wrapper ">
		<?php $this->RenderBody(); ?>	
	</div>	
	<footer id="footer">
		<a href="https://github.com/daofresh/tomato">Tomato Framework</a>	© 2014 | 
		<a href="mailto:daofresh@gmail.com?subject=[Tomato Framework] - Your subject">dsfdsf</a>
	</footer>
	<?php $this->RenderScript(); ?>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo Jsonconfig::$_config["base"]["title"] ?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
	<?php Template::RenderStyle(); ?>
</head>
<body>
	<header id="header" class="">
		<?php Template::ActionLink('<div class="logo"><h1>TOMATO</h1></div>') ?>
		<div class="top-menu">
			<nav>
				<ul>
					<li><?php Template::ActionLink('Home') ?></li>
					<li><?php Template::ActionLink('Demo page', 'home', 'demo') ?></li>
					<li><?php Template::ActionLink('Demo page (with sky template)', 'home', 'demo/sky') ?></li>
					<li><?php Template::ActionLink('Items', 'item') ?></li>
				</ul>
			</nav>
		</div>
	</header><!-- /header -->
	<div class="main-body">
		<?php Template::RenderBody(); ?>	
	</div>	
	<footer id="footer">
		<a href="https://github.com/daofresh/tomato">Tomato Framework</a>	© 2014 | 
		<a href="mailto:daofresh@gmail.com?subject=[Tomato Framework] - Your subject"><img src="<?= BASE_URL ?>images/social/email.png" alt=""></a>
		<a href="http://fb.com/khacdaodl"><img src="<?= BASE_URL ?>images/social/facebook.png" alt=""></a>
		<a href="http://twitter.com/daofresh"><img src="<?= BASE_URL ?>images/social/twitter.png" alt=""></a>
	</footer>
	<?php Template::RenderScript(); ?>
</body>
</html>
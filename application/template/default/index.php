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
		This is header
	</header><!-- /header -->
	<div class="main-body">
		<?php Template::RenderBody(); ?>	
	</div>	
	<footer>
		This is footer
	</footer>
	<?php Template::RenderScript(); ?>
</body>
</html>
# TOMATO
Easy way to create your website by PHP with software architectural pattern MVC


### Quick View
* Controller
    ```php
public function index()
	{
		//
	}
    ```

* Controller to View (with Model)
    ```php
public function index()
	{
		$model = 'This is model';
		$this->view('index', $model); 
	}
```

* Template
    ```php
	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8">
		<?php Template::RenderStyle(); ?>
	</head>
	<body>
		<div class="main-page">
			<?php Template::RenderBody(); ?>
		</div>
		<?php Template::RenderScript(); ?>
	</body>
	</html>
```

* Bundle config

    ```php
	// Setup assets for your template

	Template::AddStyle(array(
		"bootstrap" => array("bootstrap.css"),
		"style" => array("animation.css", "style.css"),
	));

	Template::AddScript(array(
		"jquery" => array("jquery-1.11.1.min.js"), 
		"bootstrap" => array("bootstrap.min.js"),
		"angular" => array("angular.min.js", "angular-route.min.js", "app.js"),
	));
```

## Get started
https://github.com/daofresh/tomato/wiki

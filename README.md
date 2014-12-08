# TOMATO
Easy way to create your website by PHP with software architectural pattern MVC

[![Tomato Framework](https://cloud.githubusercontent.com/assets/5574919/5331851/5cec65c8-7e6f-11e4-9c42-d1976fd097d6.png)](https://github.com/daofresh/tomato/releases)


### Quick View
* Controller
    ```php
  class Home extends TM_Controller
  {
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

* Change template of view (with Model)
    ```php
public function index()
	{
		$model = 'This is model';
		$this->template = 'sky';
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

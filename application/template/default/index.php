<!doctype html>
<html lang="vi">
<head>
	<meta charset="utf-8">
	<title><?php echo Jsonconfig::$_config["base"]["title"] ?></title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
	<!-- Latest compiled and minified JavaScript -->
	
	<?php Template::RenderStyle(); ?>
</head>
<body>
	<header>
	</header>
	<?php Template::RenderBody(); ?>
	<div class="new-wish"><i class="fa fa-plus"></i></div>
	<div class="overlay">
		<div class="innerpoop lol"></div>
		<div class="add-wish">
			<h2>Viết ước nguyện</h2>
			<input type="text" class="form-control" placeholder="Nhập tên"/>
    		<textarea class="message form-control"></textarea>
			<button class="btn btn-primary add-image">Thêm hình ảnh</button>
			<hr />
			<div class="navbar-right">
				<button id="send-wish" class="btn btn-success">Gửi điều ước</button>
				<button id="cancel" class="btn btn-default">Hủy bỏ</button>
			</div>
		</div>
	</div>
	<?php Template::RenderScript(); ?>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>
</html>
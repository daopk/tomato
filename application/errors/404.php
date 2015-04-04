<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Error</title>
	<link rel="stylesheet" href="">
	<style type="text/css" media="screen">
		@import url(https://fonts.googleapis.com/css?family=Inconsolata);
		html,
		body {
			background: rgb(22, 22, 22);
			font-family: 'Inconsolata', sans-serif;
		}
		.wrap {
			height: 200px;
			width: 400px;
			margin: 0 auto;
			margin-top: 15%;
		}
		code {
			color: white;
		}
		span.blue {
			color: #48beef;
		}
		span.comment {
			color: #7f8c8d;
		}
		span.orange {
			color: #F5B13F;
		}

	</style>
</head>
<body>
	<div class="wrap">
		<div class="404">
			<pre>
				<code>
<span class="comment">// Error controller</span>
<span class="blue">class</span> ErrorBase <span class="blue">extends</span> <span class="orange">TM_Error</span>
{
	<span class="blue">function</span> show()
 	{
 		<span class="blue">echo</span> <span class="orange">"<?= $message ?>"</span>;
 	}
}
				</code>
			</pre>
		</div>
	</div>
</body>
</html>
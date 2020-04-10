<?php
	include 'functions.php';
	checkDirectAccessToIncludeFile();
?>
<html>
		<head>
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<!-- tüm sayfalar için aynı kök uzantı-->
			<base href="http://epark.sinemakulup.com">
			<title>
			</title>

 			<!-- dinamik link rel -->
			<?php 
				print_js_or_css(cssSource());
			?>
		</head>
	<body class="font1" onload="ckVersion();">
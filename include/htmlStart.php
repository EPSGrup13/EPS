<?php
	include_once('functions.php');
	checkDirectAccessToIncludeFile();
?>
<html>
		<head>
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<!-- tüm sayfalar için aynı kök uzantı-->
			<base href="http://epark.sinemakulup.com">
			<?php
				if(defined("TITLE")) {
					echo constant("TITLE");
				} else {
					echo "<title>E-Park</title>";
				}
			?>

 			<!-- dinamik link rel -->
			<?php 
				print_js_or_css(cssSource());
			?>
		    <link rel="icon" href="/images/logo-icon.png">
		</head>
	<body class="font1" onload="ckVersion();">
<?php
	include 'functions.php';
	if(isDevelopmentModeOn())
	{
		$cssLink = isDevelopmentModeOn()."CSS/CSSFile.css";
		$cssHref = "<link rel=\"stylesheet\" type=\"text/css\" href=\"".$cssLink."\"/>";
	}
	else
	{
		$cssLink = "CSS/CSSFile.css";
		$cssHref = "<link rel=\"stylesheet\" type=\"text/css\" href=\"".$cssLink."\"/>";
	}

?>
<html>
		<head>
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<!-- tüm sayfalar için aynı kök uzantı-->
			<base href="http://epark.sinemakulup.com">
			<title>
			</title>

			<meta name="viewport" content="width=device-width, initial-scale=1">
			<?php echo $cssHref ?> <!-- dinamik link rel -->
		</head>
	<body class="font1">
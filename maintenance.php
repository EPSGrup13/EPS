<?php
	include '../include/functions.php';
?>

<head>
	<link rel="stylesheet" type="text/css" href="/CSS/style.css">
	<title>Bakım Aşamasında</title>
</head>

<body id="bakim-body">

	<article id="bakim-article">
		<h1 id="bakim-h1">Yakında burada olacağız!</h1>
		<div id="bakim-p">
			<p id="bakim-sayac"></p>
		</div>
		<div style="margin-bottom: 75%;"></div>
	</article>

	<script>

		var geriSayim = new Date("Jun 20, 2021 10:25:35").getTime();
		var x = setInterval(function() 
		{
			var now = new Date().getTime();
			var kalan = geriSayim - now;

			var gunler = Math.floor (kalan / (1000*60*60*24));
			var saatler = Math.floor ((kalan % (1000*60*60*24)) / (1000*60*60));
			var dakikalar = Math.floor ((kalan % (1000*60*60)) / (1000*60));
			var saniyeler = Math.floor ((kalan % (1000*60)) / 1000);

			document.getElementById("bakim-sayac").innerHTML = gunler + "gün " + saatler + "saat "
			+ dakikalar + "dk " + saniyeler + "sn ";

			if (kalan < 0) 
			{
				clearInterval(x);
				document.getElementById("bakim-sayac").innerHTML = "Süre Doldu";
			}
		}, 1000);

	</script>

<?php getHtmlEnd(); ?>
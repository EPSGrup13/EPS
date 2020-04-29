<?php
	define('LOADED', TRUE);
	include_once(__DIR__ . '/../include/functions.php');

	?>
<html>
	<head>
			<base href="http://epark.sinemakulup.com">
			<?php print_js_or_css(cssSource()); ?>
	</head>
<body>
	<?php
	maintenanceMode(); //header olmadığından ek olarak eklendi.
	session_start();

	if(isset($_GET["token"])) {
		if(isSessionActive()) {
			endSession(); // önceden session'ı var ise sonlandırılıyor.
		}
		$dataArray = tokenValidation($_GET["token"]);
		if(is_array($dataArray)) {
			//print_r($dataArray); //test output
			$result = tokenSession($dataArray[0], $dataArray[2], $dataArray[3]); // tokenDate ve tokenTime gönderiliyor.
			if($result) {
				session_start(); // lp-control'e aktarılacak veri için session oluşturuluyor, daha sonra şifre değiştirildiğinde session yeniden kapatılacak.
				$_SESSION["token_id"] = $dataArray[0]; // token_id için session oluşturuluyor.
				?>
				<br><br>
				<div class="lostPasswordNewPassBox">
					<div id="lp-val">
						<div><img src="<?php echo isDevelopmentModeOn(); ?>images/lock-icon.png" id="lostPasswordNewPassImg"></div>
						<h3 id="lostPasswordNewPassText">Şifre Yenileme</h3>
						<div><input type="password" name="password" class="lp-input" placeholder="Yeni Şifre"></div>
						<div><input type="password" name="password" class="lp-input" placeholder="Yeni Şifre Tekrar"></div>
						<button class="cp-btn" id="lostPasswordNewPassButton" onclick="updatePass(); return false;">Değiştir</button>
					</div>
				</div>
				<?php
			} else {
				echo "<div class=\"lostPasswordNewPassTimeOut\"><img src=\"https://i.hizliresim.com/8uwWjx.png\"class=\"lostPasswordNewPassTimeOutImg\">Şifre sıfırlama linki uzun süredir kullanılmadığından geçersizdir.</div>";
			}
		} else {
			echo $dataArray;
		}
	} else {
		closeConn();
		redirectTo("404");
	}

	closeConn();
	print_js_or_css(jsSource());
?>

	
	</body>
</html>

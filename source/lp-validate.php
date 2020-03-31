<?php
	define('LOADED', TRUE);
	include '../include/htmlStart.php';
	maintenanceMode(); //header olmadığından ek olarak eklendi.
	session_start();

	if(isset($_GET["token"])) {
		if(isSessionActive()) {
			endSession(); // önceden session'ı var ise sonlandırılıyor.
		}
		$dataArray = tokenValidation($_GET["token"]);
		if(is_array($dataArray)) {
			//print_r($dataArray); //test output
			$result = tokenSession($dataArray[2], $dataArray[3]); // tokenDate ve tokenTime gönderiliyor.
			if($result) {
				session_start(); // lp-validate'e aktarılacak veri için session oluşturuluyor, daha sonra şifre değiştirildiğinde session yeniden kapatılacak.
				$_SESSION["token_id"] = $dataArray[0]; // token_id için session oluşturuluyor.
				?>
				<br><br>
					<div id="lp-val">
						<div>Yeni Şifre: <input type="password" name="password" class="lp-input"></div>
						<div>Yeni Şifre Tekrar: <input type="password" name="password" class="lp-input"></div>
						<button class="cp-btn" onclick="updatePass(); return false;">Değiştir</button>
					</div>
				<?php
			} else {
				echo "Link uzun süredir kullanılmadığından geçersizdir.";
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


<?php
	include 'functions.php';
	session_start();

	if(isset($_GET["token"])) {
		if(isSessionActive()) {
			endSession(); // önceden session'ı var ise sonlandırılıyor.
		}
		$dataArray = tokenValidation($_GET["token"]);
		if(is_array($dataArray)) {
			?>
				<input type="password" name="password" class="lp-val">
				<input type="password" name="password" class="lp-val">
			<?php
		} else {
			echo $dataArray;
		}
	} else {
		redirectTo("cities.php"); // session bulunmadığından direk başka sayfaya yönelendiriliyor.
	}

	closeConn();
?>
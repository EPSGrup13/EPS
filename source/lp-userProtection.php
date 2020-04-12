<?php
	define('LOADED', TRUE);
	include_once(__DIR__ . '/../include/functions.php');
	maintenanceMode(); //header olmadığından ek olarak eklendi.
	session_start();

	if(isset($_GET["token"])) {
		if(isSessionActive()) {
			endSession(); // önceden session'ı var ise sonlandırılıyor.
		}
		$result = removeToken($_GET["token"]);
		if($result) {
			echo "İşleminiz gerçekleşti. Sayfayı kapatabilirsiniz.";
		} else {
			echo "İşlem gerçekleştirilirken sorun yaşandı.";
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


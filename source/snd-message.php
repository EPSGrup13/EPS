<?php
/* parks.php sayfasından gelen $_POST["message"] db gönderip JSON output verilecek
$_POST["message"] -> kullanıcının yaptığı yorum */
?>
<?php
	include_once(__DIR__ . '/../include/functions.php');
	session_start();
	pageProtection();

	if(isset($_POST["comment"]) && isset($_POST["park_id"]) && isset($_POST["point"])) {
		$result = addComment($_POST["comment"], $_POST["park_id"], $_POST["point"], $_SESSION["person_id"]);
		if($result) {
			$arr = array($array1[0]=>$array2[0], $array1[1]=>"İşleminiz gerçekleşti.");
			echo json_encode($arr);
		} else {
			$arr = array($array1[0]=>$array2[1], $array1[1]=>"Hata oluştu.");
			echo json_encode($arr);
		}
	} else {
		$arr = array($array1[0]=>$array2[1], $array1[1]=>"Hata oluştu.");
		echo json_encode($arr);
	}

	closeConn();
?>
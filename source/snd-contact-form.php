<?php
	include_once(__DIR__ . '/../include/functions.php');
	session_start();

	if(isset($_POST["firstName"]) && isset($_POST["lastName"]) && isset($_POST["email"]) && isset($_POST["phoneNo"]) && isset($_POST["city"]) && isset($_POST["message"])) {
		$result = addContactForm($_POST["firstName"], $_POST["lastName"], $_POST["email"], $_POST["phoneNo"], $_POST["city"], $_POST["message"]);
		if($result) {
			$arr = array($array1[0]=>$array2[0], $array1[1]=>"Form Gönderildi.");
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
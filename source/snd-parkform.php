<?php
	include_once(__DIR__ . '/../include/functions.php');
	session_start();

	if(isset($_POST["parkName"]) && isset($_POST["email"]) && isset($_POST["phoneNo"]) && isset($_POST["address"])) {
		$result = addParkForm($_POST["parkName"], $_POST["email"], $_POST["phoneNo"], $_POST["address"]);
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
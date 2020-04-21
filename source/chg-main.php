<?php
	include_once(__DIR__ . '/../include/functions.php');
	session_start();
	pageProtection();

	if(isset($_POST["plate"])) {
		$result = changeMain($_POST["plate"], $_SESSION["person_id"]);
		if($result) {
			$arr = array($array1[0]=>$array2[0], $array1[1]=>"İşlem gerçekleşti.");
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
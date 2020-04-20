<?php
	include_once(__DIR__ . '/../include/functions.php');
	session_start();
	pageProtection();

	if(!(isset($_POST["time"]) || isset($_POST["park_url"]))) {
		$arr = array($array1[0]=>$array2[1], $array1[1]=>"Hata oluştu.");
		echo json_encode($arr);
	} else {
		$getTime = array();
		$getTime = $_POST["time"];
		//echo "gelen post: " .$getTime;

		echo completeReservation($_POST["park_url"], $getTime, $_SESSION["person_id"]);
	}

	closeConn();

?>
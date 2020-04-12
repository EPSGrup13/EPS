<?php
	include_once(__DIR__ . '/../include/functions.php');
	session_start();
	pageProtection();

	$array1 = array();
	array_push($array1, "status");
	array_push($array1, "message");

	$array2 = array();
	array_push($array2,"success");
	array_push($array2,"failed");

	if(!(isset($_POST["time"]) || isset($_POST["park_url"]))) {
		closeConn();
		redirectTo("404");
	} else {
		$getTime = array();
		$getTime = $_POST["time"];
		//echo "gelen post: " .$getTime;

		echo completeReservation($_POST["park_url"], $getTime, $_SESSION["person_id"]);

		closeConn();
	}

?>
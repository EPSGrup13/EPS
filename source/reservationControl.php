<?php
	include '../include/functions.php';
	session_start();
	pageProtection();

	$array1 = array();
	array_push($array1, "status");
	array_push($array1, "message");

	$array2 = array();
	array_push($array2,"success");
	array_push($array2,"failed");

	if(!isset($_POST["time"])) {
		closeConn();
		redirectTo("404");
	} else {
		$getTime = array();
		$getTime = $_POST["time"];
		//echo "gelen post: " .$getTime;


		//----
		#opt 1145
		$parkURL = $_SESSION["park_url"];
		unset($_SESSION["park_url"]);
		//----

		//print_r($getTime);

		echo completeReservation($parkURL, $getTime, $_SESSION["person_id"]);

		closeConn();
	}

?>
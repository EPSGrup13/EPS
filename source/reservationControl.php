<?php
	include '../include/functions.php';
	session_start();
	pageProtection();

	if(!isset($_POST["time"]))
	{
		destroyUserSession();
	}

	$getTime = array();
	$getTime = $_POST["time"];


	//----
	#opt 1145
	$parkURL = $_SESSION["park_url"];
	unset($_SESSION["park_url"]);
	//----

	//print_r($getTime);

	completeReservation($parkURL, $getTime, $_SESSION["person_id"]);

	closeConn();

?>
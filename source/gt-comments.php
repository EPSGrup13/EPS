<?php
	include_once(__DIR__ . '/../include/functions.php');
	session_start();

	if(isset($_POST["parkId"])) {
		$getArray = getComments($_POST["parkId"]);
		if(is_array($getArray))
			echo json_encode($getArray);
		else
			echo $getArray;
	}

	closeConn();
?>
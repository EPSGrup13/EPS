<?php
	include 'functions.php';
	session_start();

	$arrayX = array();
	array_push($arrayX, "status");
	array_push($array1, "message");

	$arrayY = array();
	array_push($arrayY, "failed");

	$arrayZ = array();
	array_push($arrayZ,"Verileri gönderirken sorun oluştu");

	if(isset($_POST["password"]) && isset($_SESSION["token_id"])) {
		echo updatePass($_SESSION["token_id"], $_POST["password"]);
	} else {
		$arr = array($arrayX[0]=>$arrayY[0], $arrayX[1]=>$arrayZ[0]);
		echo json_encode($arr);
	}

	closeConn();
?>
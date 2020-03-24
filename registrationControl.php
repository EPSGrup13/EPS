<?php
	include 'functions.php';
	session_start();

	$arrayX = array();
	array_push($arrayX, "status");
	array_push($array1, "message");

	$arrayY = array();
	array_push($arrayY, "failed");

	$arrayZ = array();
	array_push($arrayZ,"Tum alanlari eksiksiz doldurunuz");


	if (isset($_POST['userName']) && isset($_POST['pass']) && isset($_POST['fName']) && isset($_POST['lName']) && isset($_POST['pNo']) && isset($_POST['email']))
	{

		$getUserName = $_POST["userName"];
		$getPassword = $_POST["pass"];
		$getEmail = $_POST["email"];
		$getFirstName = $_POST["fName"];
		$getLastName = $_POST["lName"];
		$getPhoneNo = $_POST["pNo"];

		echo userRegistration($getUserName,convertPassToMD5($getPassword),$getEmail,$getFirstName,$getLastName,$getPhoneNo);

	}
	else
	{
		$arr = array($arrayX[0]=>$arrayY[0], $arrayX[1]=>$arrayZ[0]);
		echo json_encode($arr);
	}

	closeConn();
?>
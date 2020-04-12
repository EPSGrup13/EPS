<?php
	include_once(__DIR__ . '/../include/functions.php');
	session_start();

	if(isset($_POST["mailField"]) && isset($_POST["passField"]))
	{
		echo loginControl($_POST["mailField"], convertPassToMD5($_POST["passField"]));
	}
	else
	{
		$arr = array($array1[0]=>$array2[1], $array1[1]=>"Hata oluştu.");
		echo json_encode($arr);
	}


	closeConn();
?>
<?php
	include_once(__DIR__ . '/../include/functions.php');
	session_start();

	if(isset($_POST["parkId"])) {
		$getArray = getComments($_POST["parkId"]);
		if(is_array($getArray))
			echo json_encode($getArray);
		else
			echo $getArray;
	} else {
		$arr = array($array1[0]=>$array2[1], $array1[1]=>"Hata oluştu.");
		echo json_encode($arr);
	}

	closeConn();
?>
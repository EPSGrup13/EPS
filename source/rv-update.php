<?php
	include_once(__DIR__ . '/../include/functions.php');
	session_start();

	if(isset($_POST["status"]) && isset($_POST["rvid"])) {
		//echo $_POST["status"];
		if(isSessionActive() && booleanPOCheck() && ownerRelevancy($_SESSION["person_id"], $_POST["rvid"])) {
			if($_POST["status"] === "TRUE") {
				decreaseParkCapacity($_POST["rvid"]);
				echo updateReservationStatus($_POST["rvid"], "update", 1);
			}
			else if($_POST["status"] === "FALSE")
				echo updateReservationStatus($_POST["rvid"], "remove", 3);
			else {
				$arr = array($array1[0]=>$array2[1], $array1[1]=>"Hata oluştu.");
				echo json_encode($arr);
			}
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
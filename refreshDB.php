<?php
	include 'functions.php';
	/* İşlem server saatine göre 14:00:00 de yapılıyor. TR saati ile 00:00:00.
	* -0 14 * * *-
	*/
	$timezone=0;
	date_default_timezone_set('Europe/Istanbul');
	$get_time = date("Y-m-d");
	//$get_time=date("Y/m/d h:i:s a", time() + 3600*($timezone+date("I")));

	$sql1 = "SELECT park_id FROM Park";
	$result1 = $conn->query($sql1);
	if ($result1->num_rows > 0)
	{
		while($row = $result1->fetch_assoc())
		{
			$selectParkID = $row["park_id"];
			//echo $selectParkID;

			$sql2 = "INSERT INTO parkStatus (recDate, park_id) VALUES ('$get_time','$selectParkID')";
			if (!($conn->query($sql2) === TRUE))
			{
				reportErrorLog("ReportErrorLog ErrorLog'a kayıt yaparken sorun oluştu", 1020);
			}
		}
	}
	else
	{
		reportErrorLog("getParkDetails fonksiyonunda veri çekilirken sorun oluştu", 1021);
	}
	dbFeedback();
	closeConn();
?>
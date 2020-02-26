<?php
	//include 'functions.php';
	$servername = "localhost";
	$username = "";
	$password = "";
	$dbname = "";

	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error)
	{
	    die("DB bağlantı hatası, Sisteme bilgi gönderildi.");
	}
	$conn->set_charset("utf8");

	$timezone=0;
	date_default_timezone_set('Europe/Istanbul');
	$get_time = date("Y-m-d");

	$sql1 = "SELECT park_id FROM Park";
	$result1 = $conn->query($sql1);
	if ($result1->num_rows > 0)
	{
		while($row = $result1->fetch_assoc())
		{
			$selectParkID = $row["park_id"];
			//echo $selectParkID;

			$sql2 = "INSERT INTO parkStatus (recDate, park_id) VALUES ('$get_time','$selectParkID')";
			if ($conn->query($sql2) === TRUE)
			{
				//dbFeedback();
			}
			else
			{
				//reportErrorLog("ReportErrorLog ErrorLog'a kayıt yaparken sorun oluştu", 1020);
			}
		}
	}
	else
	{
		//reportErrorLog("getParkDetails fonksiyonunda veri çekilirken sorun oluştu", 1021);
	}
	$conn->close();
?>
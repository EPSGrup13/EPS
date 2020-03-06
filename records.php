<?php
	define('LOADED', TRUE);
	include 'htmlStart.php';
	getHeader();
	pageProtection();
	isParkOwner();

	$getDate = $_GET["date"];

	$timeArray = array();
	array_push($timeArray,"00:00","01:00","02:00","03:00","04:00","05:00","06:00","07:00","08:00","09:00","10:00","11:00","12:00","13:00","14:00","15:00","16:00","17:00","18:00","19:00","20:00","21:00","22:00","23:00");
?>

<div class="content">




<?php
$details = array();
$details = parkHistory($_SESSION["person_id"], $getDate);


$statusId = $details[count($details) - 1];
unset($details[count($details) - 1]);


$recDate = $details[count($details) - 1];
unset($details[count($details) - 1]);

echo $details[count($details) - 1];
unset($details[count($details) - 1]);
echo "<br>Tarih: " .reArrangeDate($recDate). "<br><br>";

$personDetails = array();


for($i = 0; $i < count($details); $i++)
{

	if($details[$i] === "BOŞ")
	{
		echo $timeArray[$i]. " " .$details[$i]."<br>";
	}
	else
	{
		$personDetails = parkHistoryPersonFilter((int)($details[$i]), $recDate, $timeArray[$i], $statusId);

		echo $timeArray[$i]. " ";
		for($j = 0; $j < count($personDetails); $j++)
		{
			echo $personDetails[$j]." ";
		}
		echo "<br>";
		//echo $details[$i]."<br>";
	}
}

//eski versiyon incelemeden sonra kaldırılacak.
/*for($i = 0; $i < count($details); $i++)
{
	for($j = 0; $j < 26; $j++)
	{
		if($details[$i][$j] === "BOŞ")
		{
			echo $details[$i][$j]."<br>";
		}
		else
		{
			//$personDetails = parkHistoryPersonFilter((int)($details[$i][$j]));
			//for($k = 0; $k < count($personDetails); $k++)
			//{
			//	echo $personDetails[$k]." ";
			//}
			echo $details[$i][$j]."<br>";
		}
	}
	echo "<br>";
}*/
?>


</div>


<?php
	getFooter();
	getHtmlEnd();
?>
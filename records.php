<?php
	define('LOADED', TRUE);
	include_once('include/functions.php');
	includeContents("records");
	getHeader();
	pageProtection();
	isParkOwner();

	$getDate = $_GET["date"];

	$timeArray = array();
	array_push($timeArray,"00:00","01:00","02:00","03:00","04:00","05:00","06:00","07:00","08:00","09:00","10:00","11:00","12:00","13:00","14:00","15:00","16:00","17:00","18:00","19:00","20:00","21:00","22:00","23:00");
?>

<div class="content">
<div class="wrapperReservation">

<?php
echo "<div class=\"parkRecordsBox\">";
echo "<div class=\"parkRecordsBoxInfo\">";
//$details = array();
$details = parkHistory($_SESSION["person_id"], $getDate);


if(is_array($details))
{
	$statusId = $details[count($details) - 1];
	unset($details[count($details) - 1]);


	$recDate = $details[count($details) - 1];
	unset($details[count($details) - 1]);

	echo $details[count($details) - 1]; // park adı.
	unset($details[count($details) - 1]);
	echo "<br>Tarih: " .reArrangeDate($recDate). "<br><br>";
	echo "</div>";

	echo "<div class=\"parkRecordsBoxResults\">";
	$personDetails = array();

	for($i = 0; $i < count($details); $i++)
	{

		if($details[$i] === "BOŞ") {
			echo $timeArray[$i]. " " .$details[$i]."<br>";
		} else if($details[$i] === "X") {
			echo $timeArray[$i]. " <font color=\"orange\">Onay Bekliyor</font><br>";
		} else {
			$personDetails = parkHistoryPersonFilter((int)($details[$i]), $recDate, $timeArray[$i], $statusId);
			if(is_array($personDetails))
			{
				echo $timeArray[$i]. " ";
				for($j = 0; $j < count($personDetails); $j++)
				{
					echo $personDetails[$j]." ";
				}
				echo "<br>";
			}
			else
			{
				echo $timeArray[$i]. " " .$personDetails. "<br>";
			}
		}
	}
	echo "</div>";
}
else
{
	echo $details;
}

echo "</div>";
?>


</div>
</div>

<?php
	getFooter();
	getHtmlEnd();
?>
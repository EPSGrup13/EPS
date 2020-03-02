<?php
	include 'htmlStart.php';
	getHeader();
	pageProtection();
	isParkOwner();

	$getDate = $_GET["date"];
?>

<div class="content">




<?php
$details = array();
$details = parkHistory($_SESSION["person_id"], $getDate);

for($i = 0; $i < count($details); $i++)
{
	for($j = 0; $j < 3; $j++)
	{
		echo $details[$i][$j]." ";
	}
	echo "<br>";
}
?>


</div>


<?php
	getFooter();
	getHtmlEnd();
?>
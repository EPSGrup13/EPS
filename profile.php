<?php
	include 'htmlStart.php';
	getHeader();
	pageProtection();
?>

<div class="content">

<?php

echo "<div class=\"ou-profile\">";
	echo "<div class=\"profile\">";
		userProfile($_SESSION["person_id"]);
	echo "</div>";

	//echo "<br>";

	echo "<div class=\"rsv\">";
		echo "Park Adı\tSaat\tTarih\tPlaka<br>";

		$history = reservationHistory($_SESSION["person_id"]);
		//print_r($history); //output test
		for($i = 0; $i < count($history); $i++)
		{
			for($j = 0; $j < 3; $j++)
			{
				echo $history[$i][$j]." ";
			}
			echo "<br>";
		}
	echo "</div>";
echo "</div>";

?>


</div>


<?php
	getFooter();
	getHtmlEnd();
?>
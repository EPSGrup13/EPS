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

		//print_r(getWehicles($person_id));
		$wehiclesArray = getWehicles($_SESSION["person_id"]);
		if(is_array($wehiclesArray))
		{
			$lenWehiclesArray = count($wehiclesArray);
			for($i = 0; $i < $lenWehiclesArray; $i++)
			{
				echo "Plaka: ".$wehiclesArray[$i]."<br>";
			}
		}
		else
		{
			echo $wehiclesArray;
		}
			
	echo "</div>";

	echo "<div class=\"rsv\">";

		$history = reservationHistory($_SESSION["person_id"]);
		//print_r($history); //output test
		if(is_array($history))
		{
			echo "Park Adı\tSaat\tTarih\tPlaka<br>";
			for($i = 0; $i < count($history); $i++)
			{
				for($j = 0; $j < 3; $j++)
				{
					echo $history[$i][$j]." ";
				}
				echo "<br>";
			}
		}
		else
		{
			echo $history;
		}

	echo "</div>";
echo "</div>";

?>


</div>


<?php
	getFooter();
	getHtmlEnd();
?>
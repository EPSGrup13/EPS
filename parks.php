<?php
	define('LOADED', TRUE);
	include 'htmlStart.php';
	getHeader();

	$getSlugCity = $_GET["city"];

	//$parkArray = array();
	$parkArray = getParks($getSlugCity);
?>

<div class="content">



<?php
	echo getCityTitle($getSlugCity)." otoparkları: <br><br>";

	//print_r($parkArray); //output test

	if(is_array($parkArray))
	{
		for($i = 0; $i < count($parkArray); $i++)
		{
			$parkId = $parkArray[$i][0];
			echo "Park: ".$parkArray[$i][1]. "<br>";
			echo "İlçe: ".$parkArray[$i][2]. "<br>";

			$availablePark = (int)$parkArray[$i][3] - (int)$parkArray[$i][4];
			if($availablePark === 0)
			{
				echo "Park <span class=\"color2\">dolu</span>";
			}
			else
			{
				echo "Boş yer sayısı: <span class=\"color1\">".$availablePark."</span><br>";
				echo "<a href=\"".isDevelopmentModeOn()."rezervasyon/".getParkTitle($parkId)."\">Rezervasyon Yap</a>";
			}

			echo "<br><br>";
		}
	}
	else //eğer otopark bulunamadıysa veya yok ise direk hata mesajını gösterecek.
	{
		echo $parkArray;
	}

?>


</div>


<?php
	getFooter();
	getHtmlEnd();
?>
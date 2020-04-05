<?php
	define('LOADED', TRUE);
	include 'include/htmlStart.php';
	getHeader();

	$getSlugCity = $_GET["city"];

	//$parkArray = array();
	$parkArray = getParks($getSlugCity);
?>

<div class="content">

<?php


	//print_r($parkArray); //output test
    echo "<div class=\"parkPageForCity\">";
	echo "<div class=\"parkPageForCityName\">".getCityTitle($getSlugCity)." Otoparkları </div>";
    
	if(is_array($parkArray))
	{
		
		for($i = 0; $i < count($parkArray); $i++)
		{
			echo "<div class=\"parkPageForCityReservationOptions\">";
			$parkId = $parkArray[$i][0];
			echo "<p class=\"parkPageForCityReservationOptionsText\">Otopark Adı: ".$parkArray[$i][1]."</p>";
			echo "<p class=\"parkPageForCityReservationOptionsText\">İlçe: ".$parkArray[$i][2]."</p>";

			$availablePark = (int)$parkArray[$i][3] - (int)$parkArray[$i][4];
			if($availablePark === 0)
			{
				echo "Otopark <span class=\"color2\">dolu</span>";
			}
			else
			{
				echo "<p class=\"parkPageForCityReservationOptionsText\">Boş yer sayısı: <span class=\"color1\">".$availablePark."</span></p>";
				echo "<a class=\"parkPageForCityReservationOptionsText\" href=\"".isDevelopmentModeOn()."rezervasyon/".getParkTitle($parkId)."\">Rezervasyon Yap</a>";
			}
			echo "</div>";
		}
		
	}
	else //eğer otopark bulunamadıysa veya yok ise direk hata mesajını gösterecek.
	{
		echo $parkArray;
    }


    echo "<div class=\"pagination\" style=\"margin-top:32px;\">
    <a href=\"javascript:void(0)\">«</a>
    <a href=\"javascript:void(0)\" class=\"active\">1</a>
    <a href=\"javascript:void(0)\">2</a>
    <a href=\"javascript:void(0)\">3</a>
    <a href=\"javascript:void(0)\">4</a>
    <a href=\"javascript:void(0)\">5</a>
    <a href=\"javascript:void(0)\">6</a>
    <a href=\"javascript:void(0)\">»</a>
    </div>";

    echo "</div>";
?>

</div>

<?php
	getFooter();
	getHtmlEnd();
?>
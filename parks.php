<?php
	define('LOADED', TRUE);
	include_once('include/functions.php');
	includeContents("parks");
	getHeader();

	$getSlugCity = $_GET["city"];

	//$parkArray = array();
	$parkArray = getParks($getSlugCity);
?>

<div class="content">
<div class="parkPageBox">
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
			echo "<p class=\"parkPageForCityReservationOptionsText\">Otopark Adı: ".$parkArray[$i][1]." &nbsp;&nbsp;-&nbsp;&nbsp; Puan: " .avgPoint($parkId). "<img style=\" padding-left:5px; width:15px; height:15px; \"src=\"https://i.hizliresim.com/y3dKIZ.png\"></p>";
			echo "<p class=\"parkPageForCityReservationOptionsText\">İlçe: ".$parkArray[$i][2]."</p>";

			$availablePark = (int)$parkArray[$i][3] - (int)$parkArray[$i][4];
			if($availablePark === 0)
			{
				echo "Otopark <span class=\"color2\">dolu</span>";
			}
			else
			{
				echo "<p class=\"parkPageForCityReservationOptionsText\">Boş yer sayısı: <span class=\"color1\">".$availablePark."</span></p>";
				echo "<button class=\"parkPageButton\"><a class=\"parkPageButtonText\" href=\"".isDevelopmentModeOn()."park/".getParkTitle($parkId)."\"><span>Rezervasyon Yap</span></a></button>";
				echo "<button class=\"parkPageButton\"><a class=\"parkPageButtonText\" href=\"javascript:void(0)\" onclick=\"comments(" .$parkId. "); return false;\"><span>Yorumlar ve Puanlar</span></a></button>";
			}
			echo "</div>";
		}
		
	}
	else //eğer otopark bulunamadıysa veya yok ise direk hata mesajını gösterecek.
	{
		echo $parkArray;
    }


    echo "<div class=\"pagination\" style=\"margin-top:13px;\">
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
</div>

<?php
	getFooter();
	getHtmlEnd();
?>
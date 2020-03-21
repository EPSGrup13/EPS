<?php
	define('LOADED', TRUE);
	include 'htmlStart.php';
	getHeader();
	pageProtection();

	$checkWehicles = numOfWehicles($_SESSION["person_id"]);

	//----
	#opt 1145
	$getSlugParkURL = $_GET["park"];
	$_SESSION["park_url"] = $getSlugParkURL;
	//----


	//$parkArray = array();
	$parkArray = getParkDetails($getSlugParkURL);

	$timeArray = array();
	array_push($timeArray,"00:00","01:00","02:00","03:00","04:00","05:00","06:00","07:00","08:00","09:00","10:00","11:00","12:00","13:00","14:00","15:00","16:00","17:00","18:00","19:00","20:00","21:00","22:00","23:00");

	//print_r($parkArray);

	//Arraydeki son 5 veriyi çekerek siler, daha sonraki veriler işlenecek verilerdir.
	$localF = $parkArray[count($parkArray)-1];
	unset($parkArray[count($parkArray)-1]);
	$localL = $parkArray[count($parkArray)-1];
	unset($parkArray[count($parkArray)-1]);
	$localD = $parkArray[count($parkArray)-1];
	unset($parkArray[count($parkArray)-1]);
	$currentNumCars = $parkArray[count($parkArray)-1];
	unset($parkArray[count($parkArray)-1]);
	$maxNumCars = $parkArray[count($parkArray)-1];
	unset($parkArray[count($parkArray)-1]);
	$slug_title = $parkArray[count($parkArray)-1];
	unset($parkArray[count($parkArray)-1]);


	/*echo count($parkArray); //test
	print_r($parkArray); //test
	print_r($timeArray); //test*/
?>

<div class="content">
<div class="parkReservationBox">
	<?php
	echo "<div class=\"parkReservastionInfoBox\">";
	echo "<p class=\"parkReservastionInfo\">Park Adı: ". $slug_title . "</p>";
	echo "<p class=\"parkReservastionInfo\">Tarih: ". $localD ." ". vMon_tr($localF) ." ". vDay_tr($localL). "</p>";
	$availablePark = (int)$maxNumCars - (int)$currentNumCars;
	if($availablePark == 0) //boş yer yok ise kırmızı dolu, var ise sayısını yeşil yazdırır.
	{
		echo "Park <span class=\"color2\">dolu</span>";
	}
	else
	{
		echo "<p class=\"parkReservastionInfo\">Boş yer sayısı: <span class=\"color1\">".$availablePark."</span></p>";

	}
	
	echo "</div>";
	echo "<div class=\"parkReservationTimeBox\">";
	echo "<form action=\"".getLink("reservationControl")."\" method=\"post\" class=\"parkReservationTimeForm\">";
?>
	<div style="display:table-cell; padding-left:80px;">
<?php


	for($i = 0; $i < count($parkArray); $i++)
	{
		if($i == (count($parkArray)/2))
		{
			echo "</div>
			<div style=\"display:table-cell;padding-right:80px;\">
			<div style=\"display:table-row;\"><img src=\"https://i.hizliresim.com/3j0L1k.png\" class=\"parkReservationCarImg\">".$timeArray[$i].": ".parkDetailCheckBox($parkArray[$i], $timeArray[$i])."</div>";
		}
		else
		{
			echo "<div style=\"display:table-row;\"><img src=\"https://i.hizliresim.com/3j0L1k.png\" class=\"parkReservationCarImg\">".$timeArray[$i].": ".parkDetailCheckBox($parkArray[$i], $timeArray[$i])."</div>";
		}
	}

	echo "</div>";
?>


<?php
	echo "<div style=\"display:table-row\">";
	if($checkWehicles)
	{
		echo "<input type=\"submit\" value=\"Rezervasyon Yap\" class=\"reservationButton\">";
	}
	else
	{
		echo "<input type=\"submit\" value=\"Rezervasyon Yap\" disabled>
		<br>Sistemde kayıtlı aracınız olmadan rezervasyon yapamazsınız.";
	}
	echo "</div>";
?>

</form>
</div>
</div>
</div>

<?php
	getFooter();
	getHtmlEnd();
?>
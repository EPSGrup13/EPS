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

	//Arraydeki son 3 veriyi çekerek siler, daha sonraki veriler işlenecek verilerdir.
	$localDateType = $parkArray[count($parkArray)-1];
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

	<?php
	echo "Park Adı: ". $slug_title."<br>";
	$availablePark = (int)$maxNumCars - (int)$currentNumCars;
	if($availablePark == 0) //boş yer yok ise kırmızı dolu, var ise sayısını yeşil yazdırır.
	{
		echo "Park <span class=\"color2\">dolu</span>";
	}
	else
	{
		echo "Boş yer sayısı: <span class=\"color1\">".$availablePark."</span><br>";

	}
	echo "Tarih: ". $localDateType;


echo "<form action=\"".getLink("reservationControl")."\" method=\"post\" style=\"display:table;width:500px;background-color:gray;\">";
?>
	<div style="display:table-cell;">
<?php


	for($i = 0; $i < count($parkArray); $i++)
	{
		if($i == (count($parkArray)/2))
		{
			echo "</div>
			<div style=\"display:table-cell;min-width:50%;\">
			<div style=\"display:table-row;\">".$timeArray[$i].": ".parkDetailCheckBox($parkArray[$i], $timeArray[$i])."</div>";
		}
		else
		{
			echo "<div style=\"display:table-row;\">".$timeArray[$i].": ".parkDetailCheckBox($parkArray[$i], $timeArray[$i])."</div>";
		}
	}
?>
</div>

<?php
	echo "<div style=\"display:table-row\">";
	if($checkWehicles)
	{
		echo "<input type=\"submit\" value=\"Kayıt\">";
	}
	else
	{
		echo "<input type=\"submit\" value=\"Kayıt\" disabled>
		<br>Sistemde kayıtlı aracınız olmadan rezervasyon yapamassınız.";
	}
	echo "</div>";
?>

</form>

</div>


<?php
	getFooter();
	getHtmlEnd();
?>
<?php
	define('LOADED', TRUE);
	include_once('include/functions.php');
	includeContents("cities");
	getHeader();

	$citiesArray = array();
	$citiesArray = getAllCities(82);
?>

<div class="citiesBox">
	<center class="citiesTop"> Bulunduğunuz şehri seçiniz </center>
	<?php //cityFrame div'i tüm şehirlerin listelendiği genel div ?>
	<div class="cityFrame">
				<?php
					for($i = 0; $i < count($citiesArray); $i++)
					{
						//city olan kısım her şehrin görünümünü birbirinden ayıran kısım
						echo "<div class=\"city\">";
							echo "<div class=\"cityNum\">" .$citiesArray[$i][0]. "</div>"; // plaka kodu için olan div
							echo "<div class=\"cityName\"><a href=\"".isDevelopmentModeOn()."".$citiesArray[$i][1]."/parklar\">".$citiesArray[$i][2]."</a></div>"; // il adı için olan div
						echo "</div>";
					}
				?>
	</div>

</div>


<?php
	getFooter();
	getHtmlEnd();
?>
<?php
	define('LOADED', TRUE);
	include 'htmlStart.php';
	getHeader();
	pageProtection();

	$profileArray = userProfile($_SESSION["person_id"]);
	$firstName = $profileArray[count($profileArray) - 1];
	unset($profileArray[count($profileArray) - 1]);
	$lastName = $profileArray[count($profileArray) - 1];
	unset($profileArray[count($profileArray) - 1]);
	$balance = $profileArray[count($profileArray) - 1];
	unset($profileArray[count($profileArray) - 1]);

	$personCity = personCity($_SESSION["person_id"]); // kişinin city_id çekiyor.

	$citiesArray = array();
	$citiesArray = getAllCities(83);
	$undefinedCity = $citiesArray[count($citiesArray) -1];
	unset($citiesArray[count($citiesArray) - 1]);

?>

<div class="content">
	<div id="formkapsamprofilim">

	<div class="editProfileTop">
	   <img src="https://i.hizliresim.com/p7PP6q.png" style="width: 70px; height: 70px; padding-top: 10px;">

	   	<br>
		<?php echo "İsim Soyisim: <input type=\"text\" name=\"fullName\" class=\"profileInput\" placeholder=\"" .$firstName. " " .$lastName. "\">"; ?>
	</div>


		    <div class="profilimbilgilerdiv">
		        <div class="profilimaracbilgileridiv">
		            <div class="profilimaracbilgileriyazisi">
		            	<div class="lText1">
		            		Araç Bilgileri
		            	</div>
		            	<div class="rIcon">
			        	</div>
		            </div>
		        </div>


			        <?php
						//print_r(getWehicles($person_id));
						$wehiclesArray = getWehicles($_SESSION["person_id"]);
						if(is_array($wehiclesArray))
						{
							$lenWehiclesArray = count($wehiclesArray);
							for($i = 0; $i < $lenWehiclesArray; $i++)
							{
								echo "Plaka: <input type=\"text\" class=\"profileInput\" placeholder=\"".$wehiclesArray[$i]."\"><br>";
							}
						}
						else
						{
							echo $wehiclesArray;
						}
					?>


		        <div class="profilimiletisimbilgilerdiv">
		            <div class="profilimiletisimbilgileryazisi">
		            	<div class="lText1">
		            		İletişim Bilgileri
		            	</div>
		            	<div class="rIcon">
		            	</div>
		            </div>
		        </div>

			        <?php
			        	$matchText = array("Telefon No: ", "Email: ");
			        	$inputName = array("pNo", "email");
						for($i = 0; $i < (count($profileArray) - 1); $i++) // city harici yapıldığından çıkarıldı
						{
							echo $matchText[$i]. " <input type=\"text\" name=\"" .$inputName[$i]. "\" class=\"profileInput\" placeholder=\"" .$profileArray[$i]. "\"><br>";
						}

						// option başlangıç
						/*
						*En üstte 'Belirtilmemiş' çıkacak şekilde, 81 il listenelir,
						*haricinde kullanıcının bulunduğu şehir paylaşılmış ise o seçili çıkar,
						*seçilmemiş ise direk belirtilmemiş seçili gelir.
						*/

						echo "İl: <select id=\"cities\" name=\"cities\">";
						if($undefinedCity[0] == $personCity)
						{
							echo "<option value=\"" .$undefinedCity[0]. "\" selected> " .$undefinedCity[2]. " </option>";
						}
						else
						{
							echo "<option value=\"" .$undefinedCity[0]. "\"> " .$undefinedCity[2]. " </option>";
						}

						for($i = 0; $i < count($citiesArray); $i++)
						{
							if($citiesArray[$i][0] == $personCity)
							{
								echo "<option value=\"" .$citiesArray[$i][0]. "\" selected> " .$citiesArray[$i][2]. " </option>";
							}
							else
							{
								echo "<option value=\"" .$citiesArray[$i][0]. "\"> " .$citiesArray[$i][2]. " </option>";
							}
						}
						echo "</select>";
						// option bitiş

						echo "<br><br>Bakiye: " .$balance. "₺";
					?>

		    </div>


			<div>
			    <div class="profilimyeniaracdiv">
			    	<div class="newCar1">
			        	Yeni Araç Ekle
			    	</div>
			    	<div class="rIcon">
			        	<img src="https://i.hizliresim.com/PCeHt1.png" class="profilimyeniaracekleimg"/>
			    	</div>
			    </div>
			</div>

		<button class="ep-btn" onclick="editProfile(); return false;">Profili Güncelle</button>
	</div>
</div>





<?php
	getFooter();
	getHtmlEnd();
?>
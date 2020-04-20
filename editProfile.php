<?php
	define('LOADED', TRUE);
	include_once('include/functions.php');
	includeContents("editProfile");
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
	<div id="formkapsamprofilim" style="width:820px; margin-top: -325px; border-radius: 10px;">

	<div class="editProfileTop" style="float: left; height:280px;">
	   <img src="https://i.hizliresim.com/p7PP6q.png" class="editProfilePhoto"><input type="file" name="profilePhoto" style="padding-left: 100px; padding-bottom: 15px;">
	   	<br>
		<?php echo "<div class=\"editProfileText\">İsim Soyisim:</div><div class=\"editProfileInput\"><input type=\"text\" name=\"fullName\" class=\"profileInput\" placeholder=\"" .$firstName. " " .$lastName. "\"></div>"; ?>
		<br><div class="editProfileText"> Şifre: </div><div class="editProfileInput"><input type="password" name="pass" class="profileInput" placeholder="****"></div>
		<br><div class="editProfileText">Şifre Tekrar:</div><div class="editProfileInput"> <input type="password" class="confirmPass" placeholder="****"></div>
	</div>


		    <div class="profilimbilgilerdiv" style="float: right;">
		        <div class="profilimaracbilgileridiv">
		            <div class="profilimaracbilgileriyazisi">
		            	<div class="lText1">Araç Bilgileri</div>
		            	<!--<div class="rIcon"></div>-->
		            </div>
		        </div>
		        <div class="plate-ar scrollable">

			        <?php
						//print_r(getWehicles($person_id));
						$wehiclesArray = getWehicles($_SESSION["person_id"]);
						if(is_array($wehiclesArray))
						{
							$lenWehiclesArray = count($wehiclesArray);
							for($i = 0; $i < $lenWehiclesArray; $i++)
							{
								echo "<div class=\"editProfileText\">Plaka:</div><div class=\"editProfileInput\"><input type=\"text\" class=\"profileInput\" placeholder=\"".$wehiclesArray[$i]."\"></div><br>";
							}
						}
						else
						{
							echo $wehiclesArray;
						}
					?>
				</div>


		        <div class="profilimiletisimbilgilerdiv" style="margin-top: 20px;">
		            <div class="profilimiletisimbilgileryazisi">
		            	<div class="lText1">İletişim Bilgileri</div>
		            	<!--<div class="rIcon"></div>-->
		            </div>
		        </div>

			        <?php
			        	$matchText = array("<div class=\"editProfileText\">Telefon No:</div> ", "<div class=\"editProfileText\">Email:</div> ");
			        	$inputName = array("pNo", "email");
						for($i = 0; $i < (count($profileArray) - 1); $i++) // city harici yapıldığından çıkarıldı
						{
							echo $matchText[$i]. "<div class=\"editProfileInput\"><input type=\"text\" name=\"" .$inputName[$i]. "\" class=\"profileInput\" placeholder=\"" .$profileArray[$i]. "\"></div><br>";
						}

						// option başlangıç
						/*
						*En üstte 'Belirtilmemiş' çıkacak şekilde, 81 il listenelir,
						*haricinde kullanıcının bulunduğu şehir paylaşılmış ise o seçili çıkar,
						*seçilmemiş ise direk belirtilmemiş seçili gelir.
						*/

						echo "<div class=\"editProfileText\">İl:</div><div class=\"editProfileInput\"><select id=\"cities\" name=\"cities\">";
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
						echo "</select></div>";
						// option bitiş

						echo "<div class=\"editProfileInput\">Bakiye:" .$balance. "₺</div>"  ;
					?>
		    </div>


			<div>
			    <div class="profilimyeniaracdiv" style="width:800px; height:200px;">
			    	<div class="nc-inline scrollable">
				    	<div class="newCar1" onclick="addCarSection(); return false;">Yeni Araç Ekle</div>
				    	<button onclick="addCar(); return false;">Kayıt</button>
				    </div>
			    </div>
			</div>

		<button class="ep-btn" id="formkapsambuttongiris" style="left:28%;" onclick="editProfile(); return false;">Profili Güncelle</button>
	</div>
</div>





<?php
	getFooter();
	getHtmlEnd();
?>
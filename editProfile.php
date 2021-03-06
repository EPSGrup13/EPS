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

	<div class="profileBox">
	<div class="wrapperProfile">
	<!--yeni class eklendi sol taraftaki profil kısmı ve açılır dikey menü için-->
	<div class="profileUserMenu">
		<div class="profileUserImgDiv">
			<img class="profileUserImg" src="<?php echo isDevelopmentModeOn();?>images/default-p-avatar2.png"><!--profil resmi için class eklendi profileUserImg-->
			<div style="display:block; margin:auto; margin-top:20px;">
			<div class="isim1"><?php echo $firstName. " " .$lastName; ?></div>
		</div>
	</div>
		<!--Açılır menü başlangıç-->
		<div class="profileMenu">
  		<ul class="profileMainMenu">
    		<li><a href="">Anasayfa</a></li>
    		<li><a href="<?php echo isDevelopmentModeOn()."settings/profile/edit"; ?>">Profili Güncelle</a></li>
    		<li><a href="">Eski Rezervasyonlarım</a></li>
    		<li><a href="">Ödemelerim</a>
      	<ul class="profileSubMenu">
      		<li><a href="">Kayıtlı Kredi Kartlarım</a></li>
        	<li><a href="">Faturalarım</a></li>	
      	</ul>
    	</li>
    	<li><a href="">Yorumlarım</a></li>
    	<li><a href="">Çıkış Yap</a></li>
  		</ul>
		</div>
	</div>


	<div class="profileBoxDiv" style="height:630px;">

	<div class="profileMainDiv" style="height:290px; ">
		<div class="profileMainInnerDiv">
		    <div class="profileMainInnerDivTitle">Profil Bilgileri</div>
	   </div>

	   <img src="<?php echo isDevelopmentModeOn();?>images/default-p-avatar.png" class="editProfilePhoto">
	   <input type="file" name="profilePhoto" style="padding-left: 100px; padding-bottom: 15px; color: black;"><br>
	   	
		<?php echo "<div class=\"editProfileText\">İsim Soyisim:</div><input type=\"text\" name=\"fullName\" class=\"profileInput\" placeholder=\"" .$firstName. " " .$lastName. "\">"; ?><br>
		<div class="editProfileText">Şifre: </div><input type="password" name="pass" class="profileInput" placeholder="****"><br>
		<div class="editProfileText">Şifre Tekrar: </div><input type="password" class="confirmPass profileInput" placeholder="****"><br>
	</div>


		    <div class="profileMainDiv" style=" margin-left:3%; height:290px;">
		        <div class="profileMainInnerDiv">
		            <div class="profileMainInnerDivTitle">Araç Bilgileri</div>     
		        </div>
		        
		        <div class="plate-ar scrollable" style="display: flex; flex-direction: column;">

			        <?php
						//print_r(getWehicles($person_id));
						$wehiclesArray = getWehicles($_SESSION["person_id"]);
						if(is_array($wehiclesArray))
						{
							$lenWehiclesArray = count($wehiclesArray);
							for($i = 0; $i < $lenWehiclesArray; $i++)
							{
								echo "<div style=\"color:#5c636e; padding-top:5px;\"><div class=\"ep-plate\">Plaka: </div><div class=\"ep-plate\" style=\"width: 100px !important;\">".$wehiclesArray[$i]. "</div>";
								echo "<button class=\"editProfileSelectButton\" onclick=\"mkMain('" .$wehiclesArray[$i]. "'); return false;\">Seç</button></div>";
							}
						}
						else
						{
							echo $wehiclesArray;
						}
					?>
				</div>
			</div>

		        <div class="profileMainDiv" style="margin-top: 15px; margin-right:100px; height:250px;">
		            <div class="profileMainInnerDiv">
		            	<div class="profileMainInnerDivTitle">İletişim Bilgileri</div>
		            </div>
		        

			        <?php
			        	$matchText = array("<div class=\"editProfileText\">Telefon No:</div> ", "<div class=\"editProfileText\">Email:</div> ");
			        	$inputName = array("pNo", "email");
						for($i = 0; $i < (count($profileArray) - 1); $i++) // city harici yapıldığından çıkarıldı
						{
							echo $matchText[$i]. "><input type=\"text\" name=\"" .$inputName[$i]. "\" class=\"profileInput\" placeholder=\"" .$profileArray[$i]. "\"><br>";
						}

						// option başlangıç
						/*
						*En üstte 'Belirtilmemiş' çıkacak şekilde, 81 il listenelir,
						*haricinde kullanıcının bulunduğu şehir paylaşılmış ise o seçili çıkar,
						*seçilmemiş ise direk belirtilmemiş seçili gelir.
						*/

						echo "<div class=\"editProfileText\">İl:</div><div class=\"editProfile\"><select style=\"padding:5px; margin-left:10px; border-radius:5px; width:160px;\" id=\"cities\" name=\"cities\">";
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

						echo "<div class=\"editProfileText\" style=\"width:110px;\">Bakiye: </div><div style=\"color:#5c636e; padding-top:5px;\"> " .$balance. "₺</div>"  ;
					?>
		   		</div>
		   
			
			    <div class="profileNewCarDiv" style="margin-top: 15px; width: 380px; margin-left: -76px; height: 203px;">
			    	<div class="nc-inline scrollable">
				    	<div class="newCar1" onclick="addCarSection(); return false;">Yeni Araç Ekle <button class="editProfileSelectButton" onclick="addCar(); return false;">Kayıt</button></div>
				    	
				    </div>
			   
				</div>

		<button class="form-button" style="margin-top: 15px; width: 230px; margin-left: -200px;" onclick="editProfile(); return false;">Profili Güncelle</button>
	</div>
	</div>
	
	<!--sosyal medya menüsü için eklenen kısım-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<div class="icon-bar">
  		<a href="#" class="facebook"><i class="fa fa-facebook"></i></a> 
  		<a href="#" class="twitter"><i class="fa fa-twitter"></i></a> 
  		<a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
  		<a href="#" class="youtube"><i class="fa fa-youtube"></i></a> 
	</div>

</div>
</div>

<?php
	getFooter();
	getHtmlEnd();
?>
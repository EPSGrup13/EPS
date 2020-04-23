<?php
	define('LOADED', TRUE);
	include_once('include/functions.php');
	includeContents("profile");
	getHeader();
	pageProtection();

	$profileArray = userProfile($_SESSION["person_id"]);
	$userName = $profileArray[count($profileArray) - 1];
	unset($profileArray[count($profileArray) - 1]);
	$lastName = $profileArray[count($profileArray) - 1];
	unset($profileArray[count($profileArray) - 1]);

?>

<div class="content">
<div class="profileBox">
	<!--yeni class eklendi sol taraftaki profil kısmı ve açılır dikey menü için-->
	<div class="profileUserMenu">
		<div class="profileUserImgDiv"><!--class ismi değişti profilimkullanicifoto yerine profileUserImgDiv -->
			       <img class="profileUserImg" src="https://i.hizliresim.com/TeGNar.png"><!--profil resmi için class eklendi profileUserImg-->
			       <div style="display:block; margin:auto; margin-top:20px;">
			        	<div class="isim1"><?php echo $userName. " " .$lastName; ?></div>
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
	
	<!--sağ tarafaki div başlangıç-->
	<div class="profileBoxDiv"><!--id değişti class yapılıp formkapsamprofilim yerine profileBoxDiv -->
	
	<!--Yeni eklendi bu kısım-->
	<div class="profileWelcomeDiv ">
		<div class="profileWelcomeText">Hoşgeldin <?php echo $userName. " " .$lastName; ?></div>
	</div>
		    
	<div class="profileMainDiv" style="margin-bottom:2%; margin-right:3%; margin-top: 2%;"> <!--class ismi değişti profilimbilgilerdiv yerine profileMainDiv -->
		        <div class="profileMainInnerDiv"><!--class ismi değişti profilimaracbilgileridiv yerine profileMainInnerDiv -->
		            <div class="profileMainInnerDivTitle"><!--class ismi değişti profilimaracbilgileriyazisi yerine profileMainInnerDivTitle -->
		            	<div class="lText1">
		            		Araç Bilgileri
		            	</div>
		            </div>
		        </div>

				<div class="plateSec">
			        <?php
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
					?>
				</div>
			</div>

		        <div class="profileMainDiv" style="margin-top: 2%;"><!--class ismi değişti profilimiletisimbilgilerdiv yerine profileMainDiv -->
		        	<div class="profileMainInnerDiv"><!--class ismi değişti profilimaracbilgileridiv yerine profileMainInnerDiv -->
		            <div class="profileMainInnerDivTitle"><!--class ismi değişti profilimiletisimbilgileryazisi yerine profileMainInnerDivTitle -->
		            	<div class="lText1">
		            		İletişim Bilgileri
		            	</div>

		            </div>
		        	</div>

		        <div class="detailsSec">
			        <?php
			        	$matchText = array("Telefon No: ", "Email: ", "İl: ", "Bakiye: ");
						for($i = 0; $i < count($profileArray); $i++)
						{
							echo $matchText[$i]. " " .$profileArray[$i]. "<br>";
						}
					?>
				</div>
		    </div>

			<div class="profileMainDiv" style="width: 530px;  margin-bottom: 3%;"> <!--class ismi değişti profilimrezervasyonlarımdiv yerine profileMainDiv -->
		        <div class="profileMainInnerDiv"> <!--class ismi değişti profilimrezervasyonlarımicdiv yerine profileMainInnerDiv -->
		           <div class="profileMainInnerDivTitle" style="margin-left: 200px;">Rezervasyonlarım</div>
		        </div><!--class eklendi profileMainInnerDivTitle -->
		        <div class="reservationSec">
			        <?php
						$history = reservationHistory($_SESSION["person_id"]);
						//print_r($history); //output test
						if(is_array($history))
						{
							echo "Park Adı\tSaat\tTarih\tPlaka<br>";
							for($i = 0; $i < count($history); $i++)
							{
								for($j = 0; $j < 4; $j++)
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
					?>
				</div>

		    </div>
				
				<!--profilePanelDiv kısım kullanılmıyor -->
			    <!--<div class="profilePanelDiv">
			        <div class="profilePanelInnerDiv">
			            <div class="profilimpanelyazisi">Panel</div>
			        </div>
			        <p><a href="javascript:void(0)" class="profilePanelOptionsText">Eski Rezervasyonlarım</a></p>
			        <p><a href="javascript:void(0)" class="profilePanelOptionsText">Ödemelerim</a></p>
			        <p><a href="javascript:void(0)" class="profilePanelOptionsText">Faturalarım</a></p>
			        <p><a href="javascript:void(0)" class="profilePanelOptionsText">Yorumlarım</a></p>
			 	</div>-->

			    <div class="profileNewCarDiv" style="margin-left: 3%;"><!--class ismi değişti profilimyeniaracdiv yerine profileNewCarDiv -->
			    	<div class="newCar1">
			        	Yeni Araç Ekle
			    	</div>
			    	<div class="rIcon">
			        	<a href="#"><img src="https://i.hizliresim.com/Eor59u.png" class="profileNewCarDivImg"/></a><!--class ismi değişti rofilimyeniaracekleimg yerine profileNewCarDivImg -->
			    	</div>
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
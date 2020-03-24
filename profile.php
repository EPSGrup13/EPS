<?php
	define('LOADED', TRUE);
	include 'htmlStart.php';
	getHeader();
	pageProtection();

	$profileArray = userProfile($_SESSION["person_id"]);
	$userName = $profileArray[count($profileArray) - 1];
	unset($profileArray[count($profileArray) - 1]);
	$lastName = $profileArray[count($profileArray) - 1];
	unset($profileArray[count($profileArray) - 1]);

?>

<div class="content">
	<div id="formkapsamprofilim">
		<div class="ust">
		       <div class="profilimkullanicifoto">
			       <img src="https://i.hizliresim.com/p7PP6q.png" style="width: 180px; height: 180px;display: block; margin: auto; padding-top: 10px;">
			       <div style="display:block; margin:auto; margin-top:16px;">
			        	<div class="isim1"><?php echo $userName. " " .$lastName; ?></div>
		            </div>
		       </div>
		    <div class="profilimrezervasyonlarımdiv">
		        <div class="profilimrezervasyonlarımicdiv">
		            Rezervasyonlarım
		        </div>
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
		</div>


		<div class="alt">
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

		        <div class="profilimiletisimbilgilerdiv">
		            <div class="profilimiletisimbilgileryazisi">
		            	<div class="lText1">
		            		İletişim Bilgileri
		            	</div>
		            	<div class="rIcon">
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


			<div>
			      <div class="profilimpaneldiv">
			        <div class="profilimpanelicdiv">
			            <div class="profilimpanelyazisi">Panel</div>
			        </div>
			        <p><a href="javascript:void(0)" class="profilimpanelsecenekleri">Eski Rezervasyonlarım</a></p>
			        <p><a href="javascript:void(0)" class="profilimpanelsecenekleri">Ödemelerim</a></p>
			        <p><a href="javascript:void(0)" class="profilimpanelsecenekleri">Faturalarım</a></p>
			        <p><a href="javascript:void(0)" class="profilimpanelsecenekleri">Yorumlarım</a></p>
			    </div> 

			    <div class="profilimyeniaracdiv">
			    	<div class="newCar1">
			        	Yeni Araç Ekle
			    	</div>
			    	<div class="rIcon">
			        	<img src="https://i.hizliresim.com/PCeHt1.png" class="profilimyeniaracekleimg"/>
			    	</div>
			    </div>
			</div>
		</div>

		<a href="<?php echo isDevelopmentModeOn()."settings/profile/edit"; ?>" class="ep-btn ta-center">Profili Değiştir</a>
	</div>
</div>





<?php
	getFooter();
	getHtmlEnd();
?>
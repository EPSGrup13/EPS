<?php
	define('LOADED', TRUE);
	include 'htmlStart.php';
	getHeader();
	pageProtection();
?>

<div class="content">
	<div id="formkapsamprofilim">
		<div class="ust">
		       <div class="profilimkullanicifoto">
			       <img src="https://i.hizliresim.com/p7PP6q.png" style="width: 180px; height: 180px;display: block; margin: auto; padding-top: 10px;">
			       <div style="display:flex; justify-content:center; margin-top:16px;">
			        	<div class="isim1">İsim Soyisim</div>
		            	<img src="https://i.hizliresim.com/agyN64.png" class="profilimduzenlemeimg" style="top: 4px; left: 360px; margin-left: 5px;"/>
		            </div>
		       </div>
		    <div class="profilimrezervasyonlarımdiv">
		        <div class="profilimrezervasyonlarımicdiv">
		            <div class="profilimrezervasyonlarımyazisi">Rezervasyonlarım</div>
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
		            	Araç Bilgileri
			        	<img src="https://i.hizliresim.com/agyN64.png" class="profilimkullanicismiguncelleme"/>
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
		            	İletişim Bilgileri
		            	<img src="https://i.hizliresim.com/agyN64.png" class="profilimduzenlemeimg" style="top: 4px; left: 360px;"/>
		            </div>
		        </div>
		        <div class="detailsSec">
			        <?php
					userProfile($_SESSION["person_id"]);
					?>
				</div>
		    </div>


			<div>
			      <div class="profilimpaneldiv">
			        <div class="profilimpanelicdiv">
			            <div class="profilimpanelyazisi">Panel</div>
			        </div>
			        <p><a href="eskirezervasyonlarim.html" class="profilimpanelsecenekleri">Eski Rezervasyonlarım</a></p>
			        <p><a href="odemelerim.html" class="profilimpanelsecenekleri">Ödemelerim</a></p>
			        <p><a href="faturalarim.html" class="profilimpanelsecenekleri">Faturalarım</a></p>
			        <p><a href="yorumlarim.html" class="profilimpanelsecenekleri">Yorumlarım</a></p>
			    </div> 

			    <div class="profilimyeniaracdiv">
			        Yeni Araç Ekle
			        <img src="https://i.hizliresim.com/PCeHt1.png" class="profilimyeniaracekleimg"/>
			    </div>
			</div>
		</div>
	</div>
</div>



<?php
	getFooter();
	getHtmlEnd();
?>
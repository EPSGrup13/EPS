<?php
	define('LOADED', TRUE);
	include_once('include/functions.php');
	includeContents("reservationAccept");
	getHeader();
	pageProtection();
	isParkOwner();

	$timezone = 3;
	$today=date("Y-m-d", time() + 3600*($timezone+date("I")));
	$getData = reservationRequest($_SESSION["person_id"], $today);
	// index 0 -> person_id
	// index 1 -> full_plate
	// index 2 -> reservation_date
	// index 3 -> reservation_hour
	// index 4 -> reservation_id
?>


<div class="content">
<div class="wrapperReservation">
<div class="reservationAcceptBox">

<div class="reservationAcceptBoxMenu">
		<div class="reservationAcceptBoxMenuOption">Kullanıcı Adı</div>
		<div class="reservationAcceptBoxMenuOption">Plaka</div>
		<div class="reservationAcceptBoxMenuOption">Rezervasyon Tarihi</div>
		<div class="reservationAcceptBoxMenuOption">Rezervasyon Saati</div>
		<div class="reservationAcceptBoxMenuOption">Ödeme</div>
		<div class="reservationAcceptBoxMenuOption">Onay/Ret</div>
</div>


<div class="reservationAcceptBoxInfo" >
	<div class="scrollable">
		<?php
		if(is_array($getData)) {
			for($i = 0; $i < count($getData); $i++) {
				for($j = 0; $j < count($getData[$i]) - 1; $j++) { // array.length -1'e kadar. Son veri reservation_id
					if($j === 2) // eğer tarih olan index ise.
						echo "<div class=\"reservationAcceptBoxInfoPartial\">" .reArrangeDate($getData[$i][$j]). "</div>";
					else
						echo "<div class=\"reservationAcceptBoxInfoPartial\">" .$getData[$i][$j]. "</div>";
				}
				?>
					<div class="reservationAcceptBoxInfoPartial">Belirlenmedi</div>
					<div class="reservationAcceptBoxInfoPartialImg">
						<a href="javascript:void(0)" onclick="updateRv('false', <?php echo $getData[$i][4]; ?>)"><img src="<?php echo isDevelopmentModeOn(); ?>images/reject-icon.png" class="reservationAcceptBoxInfoImg"></a>
					</div>
					<div class="reservationAcceptBoxInfoPartialImg">
						<a href="javascript:void(0)" onclick="updateRv('true', <?php echo $getData[$i][4]; ?>)"><img src="<?php echo isDevelopmentModeOn(); ?>images/accept-icon.png" class="reservationAcceptBoxInfoImg"></a>
					</div>
				<?php
			}
		} else {
			?>
				<div class="reservationAcceptBoxInfoPartial">Kayıt bulunmamaktadır.</div>
				<div class="reservationAcceptBoxInfoPartial"></div>
				<div class="reservationAcceptBoxInfoPartialImg"></div>
				<div class="reservationAcceptBoxInfoPartialImg"></div>
			<?php
		}
		?>
	</div>	
</div>



</div>
</div>
</div>


<?php
	getFooter();
	getHtmlEnd();
?>
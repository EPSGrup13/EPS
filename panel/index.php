<?php
	define('LOADED', TRUE);
	include '../include/htmlStart.php';
	getHeader();
	//pageProtection();
	userAuth(); // session bu fonksiyonda kontrol edildiğinden pageProtection bir süreliğine deaktif edildi.

	$getData = getServerSettings();
?>

<div class="content">
	<div class="p-sidebar show">
		<a href="javascript:void(0)" class="sb-a">Link1</a>
		<a href="javascript:void(0)" class="sb-a btn-icon" onclick="expand(); return false;">Link2</a>
		<!-- <div class="sub-m" onclick="expand(event); return false;"> -->
		<div class="sub-m bd-yellow">
			<a href="javascript:void(0)" class="sb-a">Sub Link1</a>
			<a href="javascript:void(0)" class="sb-a">Sub Link2</a>
		</div>
	</div>

	<button class="p-btn" onclick="statusSidebar(); return false;">sidebar</button>

	<br><br>
	<?php
		if(is_array($getData)) {
				for($i = 0; $i < count($getData); $i++) {
						for($j = 0; $j < 3; $j++) { // 3 -> setting_id, setting_name, setting_value. Hep aynı olacağından 3 sabit.
								echo $getData[$i][$j]. " ";
						}
						echo "<br>";
				}
				//print_r($getData);
		} else
				echo $getData;

	?>



	<?php
	oopSelect();
	?>
	
</div>




<script>
	document.querySelector("body").classList.add("moveR");
</script>
<?php
	getFooter();
	getHtmlEnd();
?>
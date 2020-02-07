<?php
	include 'htmlStart.php';
	getHeader();

	$getSlugCity = $_GET["city"];
?>

<div class="content">



<?php
	getParks($getSlugCity);
?>


</div>


<?php
	getFooter();
	getHtmlEnd();
?>
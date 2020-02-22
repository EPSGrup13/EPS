<?php
	include 'htmlStart.php';
	getHeader();

	$getSlugParkURL = $_GET["park"];
?>

<div class="content">



<?php
	getParkDetails($getSlugParkURL);
?>


</div>


<?php
	getFooter();
	getHtmlEnd();
?>
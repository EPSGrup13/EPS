<?php
	define('LOADED', TRUE);
	include 'htmlStart.php';
	getHeader();
?>

<div class="content">



<?php
	getAllCities();
?>


</div>


<?php
	getFooter();
	getHtmlEnd();
?>
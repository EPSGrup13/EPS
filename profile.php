<?php
	include 'htmlStart.php';
	getHeader();
?>

<div class="content">

<?php
userProfile($_SESSION["person_id"]);
?>


</div>


<?php
	getFooter();
	getHtmlEnd();
?>
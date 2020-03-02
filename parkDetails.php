<?php
	include 'htmlStart.php';
	getHeader();
	pageProtection();
	isParkOwner();
?>

<div class="content">




<?php
$list = array();
$list = reportList($_SESSION["person_id"]);

for($i = 0; $i < count($list); $i++)
{
	echo "<a href=\"".isDevelopmentModeOn()."parkdetayi/".$list[$i]. "\">". $list[$i]."</a> Tarihli rapor.<br>";
}
?>


</div>


<?php
	getFooter();
	getHtmlEnd();
?>
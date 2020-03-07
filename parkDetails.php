<?php
	define('LOADED', TRUE);
	include 'htmlStart.php';
	getHeader();
	pageProtection();
	isParkOwner();
?>

<div class="content">




<?php
//$list = array();
$list = reportList($_SESSION["person_id"]);

if(is_array($list))
{
	for($i = 0; $i < count($list); $i++)
	{
		echo "<a href=\"".isDevelopmentModeOn()."parkdetayi/".$list[$i]. "\">". reArrangeDate($list[$i])."</a> Tarihli rapor.<br>";
	}
}
else
{
	echo $list;
}

?>


</div>


<?php
	getFooter();
	getHtmlEnd();
?>
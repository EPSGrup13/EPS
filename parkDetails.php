<?php
	define('LOADED', TRUE);
	include 'htmlStart.php';
	getHeader();
	pageProtection();
	isParkOwner();
?>

<div class="content">

<div class="parkDetailsBox">

<?php
//$list = array();
$list = reportList($_SESSION["person_id"]);

if(is_array($list))
{
	for($i = 0; $i < count($list); $i++)
	{
		echo "<div class=\"parkDetailsPartialBox\"><p class=\"parkDetailsBoxText\">
		<img src=\"https://i.hizliresim.com/xHSA5o.png\" class=\"parkDetailsImg\">
		<a href=\"".isDevelopmentModeOn()."parkdetayi/".$list[$i]. "\">". reArrangeDate($list[$i])."</a> Tarihli Raporu</p></div>";
	}
}
else
{
	echo $list;
}

echo "<div class=\"pagination\" style=\"margin-top:10px;margin-left:25px;\"><a href=\"#\">«</a>
	<a href=\"#\" class=\"active\">1</a>
    <a href=\"#\">2</a><a href=\"#\">3</a><a href=\"#\">4</a><a href=\"#\">5</a><a href=\"#\">6</a>
    <a href=\"#\">»</a></div>";
?>

</div>
</div>


<?php
	getFooter();
	getHtmlEnd();
?>
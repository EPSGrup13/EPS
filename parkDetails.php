<?php
	define('LOADED', TRUE);
	include 'include/htmlStart.php';
	getHeader();
	pageProtection();
	isParkOwner();

	$list = reportList($_SESSION["person_id"]);
	$parkName = $list[count($list) - 1];
	unset($list[count($list) - 1]);
?>

<div class="content">

<div class="parkDetailsBox">

<?php
if(is_array($list))
{
	echo "<div class=\"parkDetailsBoxTitle\">" .$parkName. " İçin Park Detayları</div>";
	echo "<div class=\"pd-date\">";
		for($i = 0; $i < count($list); $i++)
		{
			echo "<div class=\"parkDetailsPartialBox\"><p class=\"parkDetailsBoxText\">
			<img src=\"" .isDevelopmentModeOn(). "images/info-icon.png\" class=\"parkDetailsImg\">
			<a href=\"".isDevelopmentModeOn()."parkdetayi/".$list[$i]. "\">". reArrangeDate($list[$i])."</a> Tarihli Raporu</p></div>";
		}
	echo "</div>";
}
else
{
	echo $list;
}

    echo "<div class=\"pagination\">
    <a href=\"javascript:void(0)\">«</a>
    <a href=\"javascript:void(0)\" class=\"active\">1</a>
    <a href=\"javascript:void(0)\">2</a>
    <a href=\"javascript:void(0)\">3</a>
    <a href=\"javascript:void(0)\">4</a>
    <a href=\"javascript:void(0)\">5</a>
    <a href=\"javascript:void(0)\">6</a>
    <a href=\"javascript:void(0)\">»</a>
    </div>";
?>

</div>
</div>


<?php
	getFooter();
	getHtmlEnd();
?>
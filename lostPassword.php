<?php
	define('LOADED', TRUE);
	include_once('include/functions.php');
	includeContents("lostPassword");
	maintenanceMode(); //header olmadığından ek olarak eklendi.
	session_start();
?>


<div class="content">
<div class="lostPasswordPage">
	<div id="lostPasswordResetBox">

	    <img id="lostPasswordResetImg" src="<?php echo isDevelopmentModeOn(); ?>images/lock-img.png" />
	    <h3 id="lostPasswordResetText">Şifremi Unuttum</h3>
	    <form method="POST" action="">
			<div class="forResponsive"><input class="lostPwi" type="text" name="email" placeholder="E-mail"></div>
			<div><button class="ep-btn" id="lostPasswordResetButton" onclick="generateToken(); return false;">Şifre Yenile</button>
			<button class="ep-btn" id="lostPasswordResetButton"  id="passwordResetButton">Geri Dön</button></div>
	    </form>

    </div>
</div>


<?php
	closeConn();
	print_js_or_css(jsSource());
?>

	
	</body>
</html>
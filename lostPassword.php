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

	    <!--<div class="lp-alert">
	    	<span class="closebtn">×</span> 
	        <img src="<?php //echo isDevelopmentModeOn(); ?>images/info-icon.png" class="parkDetailsImg">Sistemde kayıtlı olan mail adresine şifre sıfırlama linki gönderilecektir.
		</div>-->
	    <img id="lostPasswordResetImg" src="https://i.hizliresim.com/Wo6WBE.png" />
	    <h3 id="lostPasswordResetText">Şifremi Unuttum</h3>
	    <form method="POST" action="">
			<div><input class="lostPwi" type="text" name="email" placeholder="E-mail"></div>
			<div><button class="ep-btn" id="lostPasswordResetButton"  id="passwordResetButton" onclick="generateToken(); return false;">Şifre Yenile</button><!--gerekli değil ise passwordResetButton id kaldırabilirsin kullanılmıyor-->
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

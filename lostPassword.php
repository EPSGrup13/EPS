<?php
	define('LOADED', TRUE);
	include 'include/htmlStart.php';
	maintenanceMode(); //header olmadığından ek olarak eklendi.
	session_start();
?>


<div class="content">
	<div id="passwordResetBox">
	    <img id="passwordResetImg" src="https://i.hizliresim.com/Wo6WBE.png" />
	    <h3 id="passwordResetText">Şifremi Unuttum</h3>
	    <form method="POST" action="">
			<div><input class="lostPwi" type="password" name="email" placeholder="E-mail"></div>
			<div><button class="ep-btn" id="passwordResetButton" onclick="generateToken(); return false;">Şifre Yenile</button></div>
	    </form>

	    <div class="lp-alert">
	    <!--<span class="closebtn">×</span> -->
	        <img src="<?php echo isDevelopmentModeOn(); ?>images/info-icon.png" class="parkDetailsImg">Sistemde kayıtlı olan mail adresine şifre sıfırlama linki gönderilecektir.
		</div>
    </div>
</div>


<?php
	closeConn();
	print_js_or_css(jsSource());
?>

	
	</body>
</html>

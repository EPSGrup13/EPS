<?php
	define('LOADED', TRUE);
	include 'include/htmlStart.php';
	maintenanceMode(); //header olmadığından ek olarak eklendi.
	session_start();
?>


<div class="content">

	<div id="lostPasswordResetBox">
	<div class="lp-alert">
    	<!--<span class="closebtn">×</span> -->
        <p><img src="https://i.hizliresim.com/UoyHLn.png" class="parkDetailsImg">Sistemde kayıtlı olan mail adresine şifre sıfırlama linki gönderilecektir.</p>
	</div>
    <img id="lostPasswordResetImg" src="https://i.hizliresim.com/Wo6WBE.png" />
    <h3 id="lostPasswordResetText">Şifremi Unuttum</h3>
    <form method="POST" action="">
		<div><input class="lostPwi" type="text" name="email" placeholder="E-mail"></div>
		<div><button class="ep-btn" id="lostPasswordResetButton" onclick="generateToken(); return false;">Gönder</button></div>
    </form> 
    </div>
</div>


<?php
	closeConn();
	print_js_or_css(jsSource());
?>

	
	</body>
</html>


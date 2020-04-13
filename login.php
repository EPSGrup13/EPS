<?php
	define('LOADED', TRUE);
	include 'include/htmlStart.php';
	maintenanceMode(); //header olmadığından ek olarak eklendi.
	session_start();

	if(isSessionActive())
	{
		redirectTo("cities");
	}
?>

<div class="login-container">
	<div class="login-left">
<?php echo "<form class=\"login-form\" action=\"".getLink("userlogin")."\" method=\"post\">"; ?>
	
	    <!--<img id="loginBoxImg" src="https://i.hizliresim.com/gb4jdQ.png"/>-->
	    <!--<h3 id="loginBoxText">Kullanıcı Girişi</h3>-->
	    
	        <div class="login-field">
				<h1 class="loginform-title">Giriş Yap</h1>
				<p class="loginform-subtitle">Kullanıcı bilgileriniz ile giriş yapabilirsiniz.</p>
			</div>
	        <div class="login-field">
	        	<h5 class="form-input-label">E-mail</h5>
	        	<input class="form-input" type="text" name="mailField" placeholder="E-mail">
	        </div>
	        <div class="login-field">
	        	<h5 class="form-input-label">Şifre</h5>
	        	<input class="form-input" type="password" name="passField" placeholder="Şifre">
	        </div>
	        <div class="login-field">
	        	<input class="login-button" type="submit" value="Giriş Yap">
	        	<p class="form-info-text">Henüz kayıtlı değil misin?<?php echo "<a href=\"".getLink("registration")."\"> Kayıt Ol</a>";?></p>	
	        </div>
			<!--<div style="text-align: center;">
				<a style="text-decoration: none;color: white;font-size: 15px;" href="<?php //echo isDevelopmentModeOn(); ?>password/reset">Şifremi Unuttum!</a>
			</div>-->
	    </form>

    </div>

    	<img class="login-image" src="https://images.wallpaperscraft.com/image/parking_cars_underground_131454_1080x1920.jpg">
</div>

<?php
	closeConn();
	print_js_or_css(jsSource());
?>

	
	</body>
</html>



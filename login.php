<?php
	define('LOADED', TRUE);
	include_once('include/functions.php');
	includeContents("login");
	maintenanceMode();
	session_start();

	if(isSessionActive())
	{
		redirectTo("cities");
	}
?>
<div class="page-container">
<div class="page-left">
<?php echo "<form class=\"form-login\" action=\"".getLink("userlogin")."\" method=\"post\">"; ?>

	    		        
	    	<div class="form-field">
				<h1 class="form-title">Giriş Yap</h1>
				<p class="form-subtitle">Kullanıcı bilgileriniz ile EPS'ye giriş yapabilirsiniz.</p>
			</div>
	        <div class="form-field">
	        	<h5 class="form-input-label">E-mail</h5>
	        	<input class="form-input" type="text" name="mailField" placeholder="E-mail">
	        </div>

	        <div class="form-field">
	        	<h5 class="form-input-label">Şifre</h5>
	        	<input class="form-input" type="password" name="passField" placeholder="Şifre">
	        </div>

	        <div class="form-field">
	        	<input class="form-button" type="submit" value="Giriş Yap" onclick="login(); return false;">
	        	<p class="form-info-text">Henüz kayıtlı değil misin?<?php echo "<a href=\"".getLink("registration")."\"> Kayıt Ol</a>";?></p>
	        	<p class="form-info-text"><a href="<?php echo isDevelopmentModeOn(); ?>password/reset">Şifremi Unuttum!</a></p>
	        </div>
	    </form>

</div>

    <img class="form-image" src="<?php echo isDevelopmentModeOn();?>images/img-login1.jpg">

</div>

<?php
	closeConn();
	print_js_or_css(jsSource());
?>

	
	</body>
</html>
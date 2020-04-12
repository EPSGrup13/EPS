<?php
	define('LOADED', TRUE);
	include_once('include/functions.php');
	includeContents("login");
	maintenanceMode(); //header olmadığından ek olarak eklendi.
	session_start();

	if(isSessionActive())
	{
		redirectTo("cities");
	}
	//".getLink("userlogin")."
?>


<?php echo "<form action=\"\" method=\"post\">"; ?> 
	<div id="formkapsamgiris">
	    <img id="formkapsamimggiris" src="https://i.hizliresim.com/gb4jdQ.png"/>
	    <h3 id="formkapsamhgiris">Kullanıcı Girişi</h3>

	        <div><input class="formkapsaminput" type="text" name="mailField" placeholder="E-mail"></div>
	        <div><input class="formkapsaminput" type="password" name="passField" placeholder="Şifre"></div>
	        <div class="button-row">
	        	<input class="submit-button" type="submit" value="Giriş Yap" onclick="login(); return false;">
	        	<?php echo "<a href=\"".getLink("registration")."\" style=\"text-decoration: none; color: white;\" class=\"b-type-link\">Kayıt Ol</a>";?>
	        </div>
			<div style="text-align: center;">
				<a style="text-decoration: none;color: white;font-size: 15px;" class="l-btn" href="<?php echo isDevelopmentModeOn(); ?>password/reset">Şifremi Unuttum!</a>
			</div>
	    </form>

    </div>

<?php
	closeConn();
	print_js_or_css(jsSource());
?>

	
	</body>
</html>
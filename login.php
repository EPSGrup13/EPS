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
<div class="page-container"> <!--en dış div için yeni class eklendi-->
<div class="page-left"> <!-- sayfanın sol tarafındaki div için yeni class eklendi-->
<?php echo "<form class=\"form-login\" action=\"".getLink("userlogin")."\" method=\"post\">"; ?>  <!--forma yeni class eklendi -->

	    <!--<img id="formkapsamimggiris" src="https://i.hizliresim.com/gb4jdQ.png"/>-->
	    <!--<h3 id="formkapsamhgiris">Kullanıcı Girişi</h3>-->
	    		        
	    	<div class="form-field"> <!--parça parça dive aldım yeni class eklendi-->
				<h1 class="form-title">Giriş Yap</h1> <!--form-title class eklendi-->
				<p class="form-subtitle">Kullanıcı bilgileriniz ile EPS'ye giriş yapabilirsiniz.</p><!--form-subtitle class eklendi-->
			</div>
	        <div class="form-field"> <!--parça parça dive aldım yeni class eklendi-->
	        	<h5 class="form-input-label">E-mail</h5> <!--yeni class eklendi-->
	        	<!--input class formkapsaminput yerine form-input oldu-->
	        	<input class="form-input" type="text" name="mailField" placeholder="E-mail">
	        </div>

	        <div class="form-field"> <!--parça parça dive aldım class eklendi-->
	        	<h5 class="form-input-label">Şifre</h5> <!--yeni eklendi-->
	        	<!--input class fomkapsaminput yerine form-input oldu-->
	        	<input class="form-input" type="password" name="passField" placeholder="Şifre">
	        </div>

	        <div class="form-field"> <!--parça parça dive aldım class eklendi-->
	        	<!--input class submit-button yerine form-button oldu-->
	        	<input class="form-button" type="submit" value="Giriş Yap" onclick="login(); return false;">
	        	<!--yeni eklendi-->
	        	<p class="form-info-text">Henüz kayıtlı değil misin?<?php echo "<a href=\"".getLink("registration")."\"> Kayıt Ol</a>";?></p>
	        	<p class="form-info-text"><a href="<?php echo isDevelopmentModeOn(); ?>password/reset">Şifremi Unuttum!</a></p>
	        </div>
	    </form>

</div>

	<!--ekranın sağ tarafındaki div içineresim eklendi ve bu resim için yeni class oluşturuldu-->
    <img class="form-image" src="https://images.wallpaperscraft.com/image/parking_cars_underground_131454_1080x1920.jpg">

</div>

<?php
	closeConn();
	print_js_or_css(jsSource());
?>

	
	</body>
</html>
<?php
	define('LOADED', TRUE);
	include  'htmlStart.php';
	maintenanceMode(); //header olmadığından ek olarak eklendi.
	session_start();
?>


<?php echo "<form action=\"".getLink("loginControl")."\" method=\"post\">"; ?>
	<div id="formkapsamgiris">
	    <img id="formkapsamimggiris" src="https://i.hizliresim.com/gb4jdQ.png"/>
	    <h3 id="formkapsamhgiris">Kullanıcı Girişi</h3>

	        <div><input class="formkapsaminput" type="text" name="mailField" placeholder="E-mail"></div>
	        <div><input class="formkapsaminput" type="password" name="passField" placeholder="Şifre"></div>
	        <div class="button-row">
	        	<input class="submit-button" type="submit" value="Giriş Yap">
	        	<?php echo "<a href=\"".getLink("registration")."\" style=\"text-decoration: none; color: white;\" class=\"b-type-link\">Kayıt Ol</a>";?>
	        </div>
			<div style="text-align: center;">
				<a style="text-decoration: none;color: white;font-size: 15px;" href="javascript:void(0)">Şifremi Unuttum!</a>
			</div>
	    </form>

    </div>

<?php
	closeConn();
	print_js_or_css(jsSource());
?>

	
	</body>
</html>
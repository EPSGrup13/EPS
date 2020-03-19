<?php
	define('LOADED', TRUE);
	include 'htmlStart.php';
	maintenanceMode(); //header olmadığından ek olarak eklendi.
	session_start();
?>


<?php
echo "<form action=\"".getLink("registrationControl")."\" method=\"post\" >";
?>
	<div id="formkapsamkayit">
		<img id="formkapsamimgkayit" src="https://i.hizliresim.com/3gRYd4.png" />
		<h3 id="formkapsamhkayit">Kullanıcı Kayıt Formu</h3>
		    <div><input class="formkapsaminput" type="text" name="userNameField" placeholder="Kullanıcı Adı"/></div>
		    <div><input class="formkapsaminput" type="password" name="passField" placeholder="Şifre"/></div>
		    <div><input class="formkapsaminput" type="text" name="mailField" placeholder="E-mail"/></div>
		    <div><input class="formkapsaminput" type="text" name="fNameField" placeholder="İsim" /></div>
		    <div><input class="formkapsaminput" type="text" name="lNameField" placeholder="Soyisim" /></div>
		    <div><input class="formkapsaminput" type="tel" name="pNoField" placeholder="Telefon Numarası" /></div>

		    <div class="button-row">
			<input class="submit-button" type="submit" value="Üye Ol">
			<?php echo "<a href=\"".getLink("login")."\" class=\"b-type-link\">Geri Dön</a>"; ?>
		    </div>
	</div>
</form>
<?php closeConn(); ?>

<?php
	include 'htmlStart.php';
	session_start();
?>

<?php


	echo "<form action=\"".getLink("registrationControl")."\" method=\"post\" >";
?>
		Kullanıcı Adı: <input type="text" name="userNameField" required>*<br>
		Şifre: <input type="password" name="passField" required>*<br><br>
		Email: <input type="text" name="mailField" required>*<br>
		İsim: <input type="text" name="fNameField" required>*<br>
		Soyisim: <input type="text" name="lNameField" required>*<br>
		Telefon No: <input type="text" name="pNoField" ><br>

		<input type="submit" value="Üye ol">
<?php
		echo "<a href=\"".getLink("login")."\">Geri Dön</a>";
?>
	</form>
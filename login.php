<?php
	include  'htmlStart.php';
	session_start();
?>


<?php
	echo "<form action=\"".getLink("loginControl")."\" method=\"post\">";
?>
		Email: <input type="text"  name="mailField" required><br>
		Şifre: <input type="password"  name="passField" required><br><br>
		<input type="submit" value="Giriş">
	</form>
<?php 
	echo "<a href=\"".getLink("registration")."\">Yeni Üye</a>";
?>

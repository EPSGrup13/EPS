<?php
	define('LOADED', TRUE);
	include  'htmlStart.php';
	maintenanceMode(); //header olmadığından ek olarak eklendi.
	session_start();
?>


<div class="loginBox">
<div class="loginDiv">

<?php
	echo "<form action=\"".getLink("loginControl")."\" method=\"post\">";
?>
	<center>
	<div class="loginBoxRow">
		<div class="loginBoxLeft">Email: </div>
		<div class="loginBoxRight"><input type="text" name="mailField" required="" size="25"></div>
	</div>
		
	<div class="loginBoxRow">
		<div class="loginBoxLeft">Şifre: </div>
		<div class="loginBoxRight"><input type="password" name="passField" required="" size="25"></div>
	</div>
	</center>
		
	<br>

	<center>
		<?php 
			echo "<a href=\"".getLink("registration")."\">Yeni Üye</a>";
		?>
			<input type="submit" value="Giriş" style="margin-left: 20px;">
	</center>

	</form>
</div>
</div>

<?php closeConn(); ?>
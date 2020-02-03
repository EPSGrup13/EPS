<?php
	include  'htmlStart.php';
	session_start();
?>


<div class="loginBox">

<?php
	echo "<form action=\"".getLink("loginControl")."\" method=\"post\" style=\"position: absolute;top: 50%;margin-top: -55px;\">";
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
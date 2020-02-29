<?php
	include_once('functions.php');
	checkDirectAccessToIncludeFile();
	session_start();
?>

<div class="header">

	<div class="headerInline bg-dark">

		<div class="linkBar">
			<?php echo "<a href=\"".isDevelopmentModeOn()."\">Ana Sayfa</a>"; ?>
		</div>

		<div class="userBar">
		<?php
			if(isSessionActive())
			{
				echo "<div class=\"up\"><a href=\"".isDevelopmentModeOn()."settings/profile\" class=\"uprofile\">".getSessionDisplayName()."</a>";
				if(getUserLevel() === 1) //Otopark sahibi değil ise.
				{

					echo "<div class=\"uprofile-content\">
							<a href=\"javascript:void(0)\">Park Detayları</a>

						  </div></div>";
				}
				else
				{
					echo "<div class=\"uprofile-content\">
							<a href=\"javascript:void(0)\">link1</a>

						  </div></div>";
				}

				echo "&nbsp;&nbsp;Bakiye: ".getUserBalance();
				
				echo "&nbsp;&nbsp;<a href=\"".getLink("?logout")."\">Çıkış</a>";
				if(isset($_GET["logout"]))
				{
					destroyUserSession();
				}
			}
			else
			{
				echo "<a href=\"".getLink("login")."\">Giriş Yap</a>";
			}
		?>
		</div>
	</div>

</div>


<?php
	include_once('functions.php');
	checkDirectAccessToIncludeFile();
	maintenanceMode();
	session_start();
?>

<nav class="nav-bg">

	<div class="headerInline">

		<div class="linkBar1">
			<?php
			echo "<a href=\"".isDevelopmentModeOn()."\"><img src=\"https://i.hizliresim.com/oyQbo2.png\" class=\"logo-size1\"></a>";
			?>
		</div>

		<div class="linkBar2">
			<?php
			echo "<a href=\"".isDevelopmentModeOn()."\">Ana Sayfa</a>";
			echo "<a href=\"".isDevelopmentModeOn()."contact\">İletişim</a>";
			?>
		</div>

		<div class="userBar">



			
		<?php
			if(isSessionActive())
			{
				echo "<div class=\"up\">
						<a href=\"".isDevelopmentModeOn()."settings/profile\" class=\"uprofile profileColor\">".getSessionDisplayName()."</a>";
				if(getUserLevel() === 1) //Otopark sahibi ise.
				{

					echo "<div class=\"uprofile-content\">
							<a href=\"".isDevelopmentModeOn()."parkdetayi\">Park Detayları</a>
						  ";
				}
				else
				{
					echo "<div class=\"uprofile-content\">
							<a href=\"javascript:void(0)\">link1</a>
						  ";
				}

				echo "
						<div class=\"dba\">
						Karanlık Mod
							<label class=\"switch\">
							  <input type=\"checkbox\" onclick=\"darkMode()\" id=\"dm\">
							  <span class=\"slider round\"></span>
							</label>
						</div>
					</div>
				</div>";

				echo "&nbsp;&nbsp;<font color=\"white\">Bakiye: ".getUserBalance(). "</font>";
				
				echo "&nbsp;&nbsp;<a href=\"".getLink("?logout")."\" class=\"profileColor\" style=\"display:inline-block;\">Çıkış</a>";
				if(isset($_GET["logout"]))
				{
					destroyUserSession();
				}
			}
			else
			{
				echo "<a href=\"".getLink("login")."\" class=\"profileColor\" style=\"display:inline-block;\">Giriş Yap</a>";
			}
		?>
		</div>
	</div>

</nav>
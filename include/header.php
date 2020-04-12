<?php
	include_once('functions.php');
	checkDirectAccessToIncludeFile();
	maintenanceMode();
	session_start();

    if(isset($_GET["logout"]))
    {
        destroyUserSession();
    }
?>

<nav class="nav-bg">

	<div class="headerInline">

		<div class="linkBar1">
			<?php
			echo "<a href=\"".isDevelopmentModeOn()."\"><img src=\"".isDevelopmentModeOn()."images/epark-logo.png\" class=\"logo-size1\"></a>";
			?>
		</div>

		<div class="linkBar2">
			<?php
			echo "<a href=\"".isDevelopmentModeOn()."cities\">Rezervasyon</a>";
			echo "<a href=\"".isDevelopmentModeOn()."otoparkimiz-ol\">Otoparkımız Ol</a>";
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
				else if(getUserLevel() === 2) {
						echo "<div class=\"uprofile-content\">
						<a href=\"".isDevelopmentModeOn()."panel/\">Panel</a>
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
				
				echo "&nbsp;&nbsp;<a href=\"#\" class=\"profileColor\" style=\"display:inline-block;\" onclick=\"logout(); return false;\">Çıkış</a>";
			}
			else
			{
				echo "<a href=\"".getLink("login")."\" class=\"profileColor\" style=\"display:inline-block;\">Giriş Yap</a>";
			}
		?>
		</div>
	</div>

</nav>
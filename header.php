<?php
	include_once('functions.php');
	checkDirectAccessToIncludeFile();
	session_start();
?>

<div class="header">

	<div class="headerInline">

		<div class="linkBar">
		</div>

		<div class="userBar">
		<?php
			if(isSessionActive())
			{
				getSessionDisplayName();
				echo " &nbsp;&nbsp;";
				getUserBalance();
				
				//echo "&nbsp;&nbsp;<a href=\"external/tkeskin/?logout\">logout</a>";
				echo "&nbsp;&nbsp;<a href=\"".getLink("?logout")."\">logout</a>";
				//echo "<a href=\"?logout\">logout</a>";
				if(isset($_GET["logout"]))
				{
					destroyUserSession();
				}
			}
			else
			{
				//echo "test";
				echo "<a href=\"".getLink("login")."\">Giriş Yap</a>";
				//echo "<a href=\"/external/tkeskin/login\">Giriş Yap</a>";
			}
		?>
		</div>
	</div>

</div>


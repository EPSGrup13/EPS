<?php
	define('LOADED', TRUE);
	include  'htmlStart.php';
	maintenanceMode(); //header olmadığından ek olarak eklendi.
	session_start();
?>


<div class="content">
	email: <input type="text" class="lostPwi" name="email">

	<button class="ep-btn" onclick="generateToken(); return false;">Gönder</button>
</div>


<?php
	closeConn();
	print_js_or_css(jsSource());
?>

	
	</body>
</html>


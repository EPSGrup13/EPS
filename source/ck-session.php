<?php
/* Sadece JS tarafından session'ın olup olmadığını kontrol etmek için yapılmış sayfadır
var ise TRUE yok ise FALSE YAZDIRIR (RETURN DEĞİL).
*/
?>
<?php
	include_once(__DIR__ . '/../include/functions.php');
	session_start();

	if(isSessionActive())
		echo TRUE; // not return
	else
		echo FALSE; // not return

	closeConn();
?>
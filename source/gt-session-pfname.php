<?php
/* Sadece JS tarafından SESSION var ise kullanıcı tam adını YAZDIRIR (RETURN DEĞİL).
|get session->person full name|->|gt-session-pfname|
*/
?>
<?php
	include_once(__DIR__ . '/../include/functions.php');
	session_start();

	if(isSessionActive())
		echo getSessionDisplayName(); // not return
	else
		echo "Hata"; // not return // kullanıcı adına hata yazdıracak.

	closeConn();
?>
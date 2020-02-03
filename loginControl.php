<?php
	include 'functions.php';
	session_start();


	$getMail = $_POST["mailField"];
	$getPassword = $_POST["passField"];

	if(isNullorOnlySpace($getPassword) || isNullorOnlySpace($getMail))
	{
		echo "Giriş bilgileri doğru değil. Geri Yönlendiriliyorsunuz...";
		redirectWithTimer("login");
	}
	else
	{
		loginControl($getMail,convertPassToMD5($getPassword));
	}

?>
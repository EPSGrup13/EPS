<?php
	include 'functions.php';
	session_start();


	$getMail = $_POST["mailField"];
	$getPassword = $_POST["passField"];

	if($getMail == null || $getPassword == null || $getMail == " " || $getPassword == " ")
	{
		echo "Giriş hatası ile karşılaşıldı";
	}
	else
	{
		loginControl($getMail,convertPassToMD5($getPassword));
	}

?>
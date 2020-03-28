<?php
	include 'functions.php';
	session_start();

	if(isset($_GET["token"])) {
		tokenValidation($_GET["token"]);
	} else {
		redirectTo("cities.php"); // session bulunmadığından direk başka sayfaya yönelendiriliyor.
	}

	closeConn();
?>
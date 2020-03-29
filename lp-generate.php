<?php
	include 'functions.php';
	session_start();

	if(isset($_POST["email"])) {
		if(isSessionActive()) {
			endSession();
			echo sendToken($_POST["email"]);
		} else
			echo sendToken($_POST["email"]);
	} else {
		redirectTo("cities.php"); // session bulunmadığından direk başka sayfaya yönelendiriliyor.
	}

	closeConn();
?>
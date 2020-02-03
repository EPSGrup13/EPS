<?php
	include 'functions.php';
	session_start();

	$getUserName = $_POST["userNameField"];
	$getPassword = $_POST["passField"];
	$getEmail = $_POST["mailField"];
	$getFirstName = $_POST["fNameField"];
	$getLastName = $_POST["lNameField"];
	$getPhoneNo = $_POST["pNoField"];

	if(isNullorOnlySpace($getUserName) || isNullorOnlySpace($getPassword) || isNullorOnlySpace($getEmail) || isNullorOnlySpace($getFirstName) || isNullorOnlySpace($getLastName))
	{
		echo "Tüm alanları eksiksiz doldurunuz. Geril Yönlendiriliyorsunuz...";
		redirectWithTimer("registration");
	}
	else
	{
		userRegistration($getUserName,convertPassToMD5($getPassword),$getEmail,$getFirstName,$getLastName,$getPhoneNo);
	}



?>
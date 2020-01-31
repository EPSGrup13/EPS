<?php
	include 'htmlStart.php';

	$getUserName = $_POST["userNameField"];
	$getPassword = $_POST["passField"];
	$getEmail = $_POST["mailField"];
	$getFirstName = $_POST["fNameField"];
	$getLastName = $_POST["lNameField"];
	$getPhoneNo = $_POST["pNoField"];

	userRegistration($getUserName,convertPassToMD5($getPassword),$getEmail,$getFirstName,$getLastName,$getPhoneNo);

?>
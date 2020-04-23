<?php
	include_once(__DIR__ . '/../include/functions.php');
	session_start();

	if(isSessionActive())
		echo TRUE; // not return
	else
		echo FALSE; // not return

	closeConn();
?>
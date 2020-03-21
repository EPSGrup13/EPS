<?php
session_start();

if(isset($_SESSION["person_id"]))
{
	echo $_SESSION["person_id"];
}
else
{
	echo "tanımlı değil";
}

?>
<?php
include_once(__DIR__ . '/../include/functions.php');
session_start();

if(isset($_SESSION["person_id"]))
{

	$queryMaker = "";
	// firstName, lastName birlikte [0]
	$dbRow = array("firstName, lastName", "User.userPassword", "Person.phoneNo", "Person.email", "Person.city_id");

	$dataArray = array("fullName", "pass", "pNo", "email", "cities");
	$confirmedValuesArray = array();
	for($i = 0; $i < count($dataArray); $i++)
	{
		if(isset($_POST[$dataArray[$i]]))
		{
			//echo $dataArray[$i]. " tanımlı\n"; //javascript için \n
			//array_push($confirmedValuesArray, $_POST[$dataArray[$i]]);
			$confirmedValuesArray = array_merge($confirmedValuesArray, array(array($dataArray[$i], $conn->real_escape_string($_POST[$dataArray[$i]]))));
		}
		else
		{
			//echo $dataArray[$i]. " tanımlı değil\n"; //javascript için \n
		}
	}

	//print_r($confirmedValuesArray);




	for($i = 0; $i < count($confirmedValuesArray); $i++)
	{
		//for($j = 0 ; $j < 2; $j++)
		//{
			$inputName = $confirmedValuesArray[$i][0];
			//echo $inputName. " ";
			//echo $confirmedValuesArray[$i][0];
			//$val = $dbRow[array_search($confirmedValuesArray[$i][0], $dataArray)];
			//echo $val;

			if($inputName == "fullName")
			{
				$fName = "";
				$lName = "";

				$getEnteredFullName = $confirmedValuesArray[$i][1];
				//echo strlen($getEnteredFullName);
				for($j = strlen($getEnteredFullName); $j > 0; $j--)
				{
					if($getEnteredFullName[$j] == " ")
					{
						$lName = substr($getEnteredFullName, $j+1);
						$fName = substr($getEnteredFullName, 0, $j);

						$queryMaker = $queryMaker. " Person.firstName='" .$fName. "', Person.lastName='" .$lName. "', ";
						break;
					}
				}
			} else if($inputName == "pass") {
				$pass = convertPassToMD5($confirmedValuesArray[$i][1]); // yeni şifre MD5 olarak çevriliyor.
				$queryMaker = $queryMaker. "" .$dbRow[array_search($confirmedValuesArray[$i][0], $dataArray)]. "='".$pass."', ";
			}
			else
			{
				$queryMaker = $queryMaker. "" .$dbRow[array_search($confirmedValuesArray[$i][0], $dataArray)]. "='".$confirmedValuesArray[$i][1]."', ";
			}
	}

	$queryMaker = substr($queryMaker, 0, strlen($queryMaker)-2); //sondaki , ve 1space siliniyor.
	//echo "query: " .$queryMaker;

	echo updateUserProfile($queryMaker, $_SESSION["person_id"]);

	closeConn();

}
else
{
	closeConn();
	redirectTo("login");
}

?>
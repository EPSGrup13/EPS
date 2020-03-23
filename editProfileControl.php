<?php
include 'functions.php';
session_start();

/*if(isset($_SESSION["person_id"]))
{
	echo $_SESSION["person_id"];
}
else
{
	echo "tanımlı değil";
}*/


$queryMaker = "";
$dbRow = array("firstName, lastName", "phoneNo", "email", "city_id");

$dataArray = array("fullName", "pNo", "email", "cities");
$confirmedValuesArray = array();
for($i = 0; $i < count($dataArray); $i++)
{
	if(isset($_POST[$dataArray[$i]]))
	{
		echo $dataArray[$i]. " tanımlı\n"; //javascript için \n
		//array_push($confirmedValuesArray, $_POST[$dataArray[$i]]);
		$confirmedValuesArray = array_merge($confirmedValuesArray, array(array($dataArray[$i], $_POST[$dataArray[$i]])));
	}
	else
	{
		echo $dataArray[$i]. " tanımlı değil\n"; //javascript için \n
	}
}

print_r($confirmedValuesArray);




for($i = 0; $i < count($confirmedValuesArray); $i++)
{
	//for($j = 0 ; $j < 2; $j++)
	//{
		$inputName = $confirmedValuesArray[$i][0];
		echo $inputName. " ";
		//echo $confirmedValuesArray[$i][0];
		//$val = $dbRow[array_search($confirmedValuesArray[$i][0], $dataArray)];
		//echo $val;

		if($inputName == "fullName")
		{
			$fName = "";
			$lName = "";
			//$queryMaker = $queryMaker. "" .$dbRow[array_search($confirmedValuesArray[$i][0], $dataArray)]. "='" .$confirmedValuesArray[$i][1]. "', ";
			echo $dbRow[array_search($confirmedValuesArray[$i][0], $dataArray)]. " " .$confirmedValuesArray[$i][1];

			$getEnteredFullName = $confirmedValuesArray[$i][1];
			//echo strlen($getEnteredFullName);
			for($j = strlen($getEnteredFullName); $j > 0; $j--)
			{
				if($getEnteredFullName[$j] == " ")
				{
					//echo $j;
					$lName = substr($getEnteredFullName, $j+1);
					echo "soyisim:" .$lName. "  ";
					$fName = substr($getEnteredFullName, 0, $j);
					echo "isim: " .$fName. " ";

					$queryMaker = $queryMaker. " firstName='" .$fName. "', lastName='" .$lName. "', ";
					break;
				}
			}
		}
		/*else if($inputName == "cities")
		{
			echo $dbRow[array_search($confirmedValuesArray[$i][0], $dataArray)]. " " .$confirmedValuesArray[$i][1];
			$queryMaker = $queryMaker. "" .$dbRow[array_search($confirmedValuesArray[$i][0], $dataArray)]. "=".$confirmedValuesArray[$i][1].", ";
		}*/
		else
		{
			echo $dbRow[array_search($confirmedValuesArray[$i][0], $dataArray)]. " " .$confirmedValuesArray[$i][1];
			$queryMaker = $queryMaker. "" .$dbRow[array_search($confirmedValuesArray[$i][0], $dataArray)]. "='".$confirmedValuesArray[$i][1]."', ";
		}

	//}
	echo "\n";


}

$queryMaker = substr($queryMaker, 0, strlen($queryMaker)-2);
echo "query: " .$queryMaker;

updateUserProfile($queryMaker, $_SESSION["person_id"]);

closeConn();

/*if(isset($_POST["fullName"]) && isset($_POST["pNo"]) && isset($_POST["email"]) && isset($_POST["cities"]))
{
	echo "tanımlı";
}
else
{
	echo "tanımlı değil";
}*/

?>
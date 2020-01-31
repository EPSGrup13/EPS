<?php
//hata mesajlarını göstermesini engellemek için
error_reporting(E_ERROR | E_PARSE);


	$servername = "localhost";
	$username = "";
	$password = "";
	$dbname = "";

	//bağlantı burada kuruluyor fonksiyonlarda bu değişken global olarak çekilerek devam ettirilecek.
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error)
	{
	    die("DB Bağlantı hatası");
	}
	/*else
	{
		echo "Connected."; //test için.
	}*/
	//db'den Türkçe karakter çekebilmek için.
	$conn->set_charset("utf8");


//Ana dizinde değişiklik yapmadan alt sayfalarda geliştirme modu
//-------------------------------------------------------------------
$url1="external/tkeskin/";
$url2="external/ekamis/";
$url3="external/mmor/";
$url4="external/aboga/";
$url5="external/eunlu/";


function allowDMode()
{
	return FALSE; //geliştirme durumunda TRUE olarak değiştirilecek.
}


function isDevelopmentModeOn()
{
	global $url1;

	if(allowDMode())
	{
		//define('URL', url1);
		return $url1;
	}
	else
	{
		//define('URL', "/");
		return "";
	}
}
//-------------------------------------------------------------------


function getLink($URL)
{
	global $url1;

	if(allowDMode())
	{
		if($URL == "index")
		{
			return $url1;
		}
		else
		{
			return $url1."".$URL;
		}
		//define('URL', url1);
	}
	else
	{
		if($URL == "index")
		{
			return "";
		}
		else
		{
			return "/".$URL;
		}
		//define('URL', "/");
	}
}




function getHtmlEnd() //html bitişini kısaca çekebilmek için fonksiyon
{
	allowFileInclude();
	include 'htmlEnd.php';
}

function getHeader() //header'ı kısaca çekebilmek için fonksiyon
{
	allowFileInclude();
	include 'header.php';
}

function getFooter() //footer'ı kısaca çekebilmek için fonksiyon.
{
	allowFileInclude();
	include 'footer.php';
}


/*
ePark/header şeklinde URL kısmından erişimi engellemek için yapılan kontrol sistemi.
LOADED->TRUE şeklinde çekilir ise, sayfalara erişim kontrollü olan sayfalar include edilerek kullanılabilir.
*/
function checkDirectAccessToIncludeFile()
{
	if(!defined('LOADED'))
	{
		die("Bu sayfaya direk erişim yapamazsınız!");
	}
}

//Erişim kontrol sistemine sahip sayfaları include etmeden önce kullanılabilir hale getirir.
function allowFileInclude()
{
	define('LOADED', TRUE);
}


//istenen sayfaya direk gönderme yapılabilecek örneğin redirectTo("index"); şeklinde.
function redirectTo($pageURL)
{
	//$getURL=trim($pageURL,".php");
	//index'e gidiyorsa direk /ePark/ index'e gider zaten
	if($pageURL == "index")
	{
		//header("Location: /"); //
		header("Location: /".isDevelopmentModeOn());
		exit();
	}
	//index haricindeki url için ePark/url şeklinde gönderir.
	else
	{
		//header("Location: /".$pageURL."");
		header("Location: /".isDevelopmentModeOn()."".$pageURL);
		exit();
	}
}

function redirectWithTimer($pageURL)
{
	//$getURL=trim($pageURL,".php");
	if($pageURL == "index")
	{
		header("Refresh: 3; URL=/".isDevelopmentModeOn());
		exit();
	}
	else
	{
		//header("Refresh: 3; URL=/".$pageURL."/");
		header("Refresh: 3; URL=/".isDevelopmentModeOn()."".$pageURL);// /");
		exit();
	}
}

function loginControl($getMail, $getPassword)
{
	global $conn;
	//Kullanıcıdan gelen inputu kontrol ederek sorguya göndereceğiz.
	$mailCheck = mysqli_real_escape_string($conn,$getMail);
	$passwordCheck = mysqli_real_escape_string($conn,$getPassword);
	$sql = "SELECT User.userName, User.userPassword, User.userType, User.userStatus, User.balance, Person.firstName, Person.lastName, Person.email FROM User  INNER JOIN Person ON User.person_id = Person.person_id WHERE (Person.email = \"$mailCheck\" AND User.userPassword = \"$passwordCheck\") OR (User.userName = \"$mailCheck\" AND User.userPassword = \"$passwordCheck\")";
	$result = $conn->query($sql);

	if ($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			//output testi
			//echo $row["userName"] . " " . $row["userPassword"] . " " . $row["userType"] . " " . $row["userStatus"] . " " . $row["balance"] . " " . $row["firstName"] . " " . $row["lastName"] . " " . $row["email"];

			session_start();
			$_SESSION["userName"] = $row["userName"];
			$_SESSION["userPassword"] = $row["userPassword"];
			$_SESSION["userType"] = $row["userType"];
			$_SESSION["userStatus"] = $row["userStatus"];
			$_SESSION["balance"] = $row["balance"];
			$_SESSION["firstName"] = $row["firstName"];
			$_SESSION["lastName"] = $row["lastName"];
			$_SESSION["email"] = $row["email"];
			redirectTo("index");
			//redirectTo("external/tkeskin/");
		}
	}
	else
	{
		echo "Giriş bilgileri doğru değil.";
		//echo "<br><br><a href=\"". redirectTo("login") ."\">Geri dön.</a>";
		////echo "<br><br><a href=\"".redirectWithTimer("external/tkeskin/login")."\">Geri Dön</a>";
		echo "<br><br><a href=\"login?goBack\">Geri Dön</a>";
		if(isset($_GET["goBack"]))
		{
			redirectTo("index");
		}
	}
}


function convertPassToMD5($password)
{
	$password=md5($password);
	return $password;
}

function isSessionActive()
{
	if(isset($_SESSION["userName"]) && isset($_SESSION["userPassword"]) && isset($_SESSION["userType"]) && isset($_SESSION["userStatus"]) && isset($_SESSION["balance"]) && isset($_SESSION["firstName"]) && isset($_SESSION["lastName"]) && isset($_SESSION["email"]))
	{
		$isActive = true;
	}
	else
	{
		$isActive = false;
	}
	return $isActive;
}

function destroyUserSession()
{
	session_unset();
	session_destroy();
	//redirectTo("external/tkeskin/");
	redirectTo("index");
}

function defineUserAuth()
{

}


function userRegistration($getUserName, $getPassword, $getEmail, $getFirstName, $getLastName, $getPhoneNo)
{
	$timezone=0;
	$get_time=date("Y/m/d h:i:s a", time() + 3600*($timezone+date("I")));

	global $conn;

	$convertUserName = mysqli_real_escape_string($conn, $getUserName);
	$convertPassword = mysqli_real_escape_string($conn, $getPassword);
	$convertEmail = mysqli_real_escape_string($conn, $getEmail);
	$convertFirstName = mysqli_real_escape_string($conn, $getFirstName);
	$convertLastName = mysqli_real_escape_string($conn, $getLastName);
	$convertPhoneNo = mysqli_real_escape_string($conn, $getPhoneNo);

	$sql01 = "SELECT email FROM Person WHERE email = '$convertEmail'";
	$result1 = $conn->query($sql01);
	if ($result1->num_rows > 0) //Eğer öyle bir mail varsa mail unique olduğundan kullanıcı kaydı oluşturmasını engellemek için.
	{
		echo "Bu email zaten kullanılmakta... Geri Yönlendiriliyorsunuz.";
		redirectWithTimer("registration");
	}
	else //Eğer öyle bir mail yok ise
	{
		$sql02 = "SELECT userName FROM User WHERE userName = '$convertUserName'";
		$result2 = $conn->query($sql02);
		if ($result2->num_rows > 0) //Eğer öyle bir kullanıcı adı var ise kullanıcı kaydı oluşturtma
		{
			echo "Bu kullanıcı adı zaten kullanılmakta... Geri Yönlendiriliyorsunuz.";
			redirectWithTimer("registration");
		}
		else //eğer öyle bir kullanıcı adı da yok ise artık iki tabloya da veri girilebilir.
		{
			$sql1 = "INSERT INTO Person (firstName, lastName, phoneNo, email) VALUES ('$convertFirstName','$convertLastName','$convertPhoneNo','$convertEmail')";
			$sql2 = "INSERT INTO User (userName, userPassword, person_id) VALUES ('$convertUserName','$convertPassword', (SELECT person_id FROM Person WHERE email='$convertEmail'))";

			if ($conn->query($sql1) === TRUE && $conn->query($sql2) === TRUE)
			{
			    echo "Kullanıcı Oluşturuldu. Giriş Sayfasına Yönlendiriliyorsunuz.";
		    	redirectWithTimer("login");

			}
			else
			{
			    echo "Error: " . $sql1 . " and ". $sql2 . "<br>" . $conn->error;
			}
		}
	}
	$conn->close();
}

?>
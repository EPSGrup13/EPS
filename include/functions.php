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
		reportErrorLog("DB bağlantı hatası", 1001); //db bağlanamadığından db bağlantı hatası için hata girişi yapamayacak fakat farklı hatalar için sisteme girişte sıkıntı olmayacak, bu özel durum için sadece mail gönderimi yapılacak.
	    die("DB bağlantı hatası, Sisteme bilgi gönderildi.");
	}
	/*else
	{
		echo "Connected."; //test için.
	}*/
	//db'den Türkçe karakter çekebilmek için.
	$conn->set_charset("utf8");


//Ana dizinde değişiklik yapmadan alt sayfalarda geliştirme modu
//-------------------------------------------------------------------
$url1 = "external/tkeskin/";
$url2 = "external/ekamis/";
$url3 = "external/mmor/";
$url4 = "external/aboga/";
$url5 = "external/eunlu/";

$urlSelection = $url1;


function allowDMode()
{
	return FALSE; //geliştirme durumunda TRUE olarak değiştirilecek.
}


function isDevelopmentModeOn()
{
	global $urlSelection;

	if(allowDMode())
	{
		//define('URL', url1);
		return $urlSelection;
	}
	else
	{
		//define('URL', "/");
		return "";
	}
}


//Ara sayfalarda link geçişleri için.
function getLink($URL)
{
	global $urlSelection;

	if(allowDMode())
	{
		if($URL == "index")
		{
			return $urlSelection;
		}
		else
		{
			return $urlSelection."".$URL;
		}
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
	}
}
//-------------------------------------------------------------------

class Dbpro {
	public $query;
	public $data;

	function __construct($query, $data) {
		$this->query = $query;
		$this->data = $data;
	}

	function mSelect() { //2D -> çoklu row ve çoklu column  |  çoklu grup veri
		$splitData = explode(",", $this->data);
		global $conn;
		$dataArray = array();
		$tmp = array();

		$sql = $this->query;
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				for($i = 0; $i < count($splitData); $i++) {
					array_push($tmp, $row[trim($splitData[$i], " ")]);
				}
				$dataArray = array_merge($dataArray, array($tmp));
				unset($tmp);
				$tmp = array();
			}
			return $dataArray;
		} else {
			reportErrorLog("mselect hata", 1501);
			return "Veri Hatası";
		}
	}

	// rSelect ile select temelde aynı fakat farklı metodlar, 1d row veya 1d column
	/*function rSelect() {  // 1D -> çoklu row  |  tek grup verisi
		$splitData = explode(",", $this->data);
		global $conn;
		$dataArray = array();

		$sql = $this->query;
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				//$normalData = $data;//array_merge($dataArray, $data);
				//return $row[$this->data];
				//$dataArray = array_merge($dataArray, array($row[$this->data]));

				for($i = 0; $i < count($splitData); $i++) {
					$dataArray = array_merge($dataArray, array($row[trim($splitData[$i], " ")]));
				}
			}
			return $dataArray;
		} else {
			reportErrorLog("select hata", 1502);
		}
	}*/

	function select() {  // 1D -> çoklu column  |  tek grup verisi
		$splitData = explode(",", $this->data);
		global $conn;
		$dataArray = array();

		$sql = $this->query;
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				for($i = 0; $i < count($splitData); $i++) {
					array_push($dataArray, $row[trim($splitData[$i], " ")]);
				}
			}
			return $dataArray;
		} else {
			reportErrorLog("select hata", 1502);
		}
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
		reportErrorLog("Include edilen sayfalardan birine dışarıdan erişilmeye çalışıldı.", 1014);
		redirectTo("404");
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
		header("Location: /".isDevelopmentModeOn());
		exit();
	}
	//index haricindeki url için ePark/url şeklinde gönderir.
	else
	{
		header("Location: /".isDevelopmentModeOn()."".$pageURL);
		exit();
	}
}

//Yönlendirilecek sayfalara zaman ekler. Kullanımı redirectTo ile aynı.
//Mevcut durumda hatalı üye girişi, 404 vb. sayfalarda kullanılmakta.
function redirectWithTimer($pageURL)
{
	if($pageURL == "index")
	{
		header("Refresh: 3; URL=/".isDevelopmentModeOn());
		exit();
	}
	else
	{
		header("Refresh: 3; URL=/".isDevelopmentModeOn()."".$pageURL);// /");
		exit();
	}
}


//Kullanıcı giriş yaparken e-mail veya id ikisinden birini kullanarak giriş yapabilir.
//Kullanıcı giriş bilgilerini doğrular ve session oluşturur.
function loginControl($getMail, $getPassword)
{
	global $conn;
	//Kullanıcıdan gelen inputu kontrol ederek sorguya göndereceğiz.
	$mailCheck = mysqli_real_escape_string($conn,$getMail);
	$passwordCheck = mysqli_real_escape_string($conn,$getPassword);
	$sql = "SELECT User.userName, User.userPassword, User.userType, User.userStatus, User.balance, User.person_id, Person.firstName, Person.lastName, Person.email FROM User  INNER JOIN Person ON User.person_id = Person.person_id WHERE (Person.email = \"$mailCheck\" AND User.userPassword = \"$passwordCheck\") OR (User.userName = \"$mailCheck\" AND User.userPassword = \"$passwordCheck\")";
	$result = $conn->query($sql);

	if ($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{

			session_start();
			$_SESSION["userName"] = $row["userName"];
			$_SESSION["userPassword"] = $row["userPassword"];
			$_SESSION["userType"] = $row["userType"];
			$_SESSION["userStatus"] = $row["userStatus"];
			$_SESSION["balance"] = $row["balance"];
			$_SESSION["person_id"] = $row["person_id"];
			$_SESSION["firstName"] = $row["firstName"];
			$_SESSION["lastName"] = $row["lastName"];
			$_SESSION["email"] = $row["email"];
			if((int)$_SESSION["userType"] === 2)
			{
				reportAuth($_SESSION["userName"],$_SESSION["firstName"],$_SESSION["lastName"],$_SESSION["person_id"]);
				//echo $_SESSION["userType"]; //test
			}
			redirectTo("cities");
		}
	}
	else
	{
		echo "Giriş bilgileri doğru değil. Geri Yönlendiriliyorsunuz...";
		redirectWithTimer("login");
	}
}

function getAllCities($maxNum)
{
	global $conn;
	$citiesArray = array();

	$sql = "SELECT City.city_id, Slug.slug_title, Slug.slug_url FROM City INNER JOIN Slug ON City.slug_id = Slug.slug_id WHERE City.city_id < '$maxNum'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			$citiesArray = array_merge($citiesArray, array(array($row["city_id"], $row["slug_url"], $row["slug_title"])));
		}
		return $citiesArray;
	}
	else
	{
		echo "Verileri çekerken sorun oluştu."; //bu sayfa direk index olduğundan redirect yapılmayacak.
		reportErrorLog("getAllCities fonksiyonunda veri çekilirken sorun oluştu", 1012);
		//redirectWithTimer("index");
	}
	//#$conn->close();
}


function convertPassToMD5($password)
{
	$password=md5($password);
	return $password;
}

//Mevcutta session var mı diye kontrol eder.
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


//Mevcut session'ı sonlandırır.
function destroyUserSession()
{
	session_unset();
	session_destroy();
	redirectTo("cities");
}

// Redirect yapmadan session sonlandırır.
function endSession() {
	session_unset();
	session_destroy();
}

function userAuth()
{
	if(getUserLevel() != 2) {
			if(!(isSessionActive())) {
					destroyUserSession();
			} else {
					redirectTo("cities");
			}
	}
}


function userRegistration($getUserName, $getPassword, $getEmail, $getFirstName, $getLastName, $getPhoneNo)
{
	$array1 = array();
	array_push($array1, "status");
	array_push($array1, "message");

	$array2 = array();
	array_push($array2,"success");
	array_push($array2,"failed");

	$array3 = array();
	array_push($array3,"email zaten var");
	array_push($array3,"kullanici adi zaten var");
	array_push($array3,"kayit olusturuldu");
	array_push($array3,"kayit yapilirken sorun olustu");


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
		$arr = array($array1[0]=>$array2[1], $array1[1]=>$array3[0]);
	    return json_encode($arr);
	}
	else //Eğer öyle bir mail yok ise
	{
		$sql02 = "SELECT userName FROM User WHERE userName = '$convertUserName'";
		$result2 = $conn->query($sql02);
		if ($result2->num_rows > 0) //Eğer öyle bir kullanıcı adı var ise kullanıcı kaydı oluşturtma
		{
			$arr = array($array1[0]=>$array2[1], $array1[1]=>$array3[1]);
		    return json_encode($arr);
		}
		else //eğer öyle bir kullanıcı adı da yok ise artık iki tabloya da veri girilebilir.
		{
			$sql1 = "INSERT INTO Person (firstName, lastName, phoneNo, email) VALUES ('$convertFirstName','$convertLastName','$convertPhoneNo','$convertEmail')";
			$sql2 = "INSERT INTO User (userName, userPassword, person_id) VALUES ('$convertUserName','$convertPassword', (SELECT person_id FROM Person WHERE email='$convertEmail'))";

			if ($conn->query($sql1) === TRUE && $conn->query($sql2) === TRUE)
			{
    			$arr = array($array1[0]=>$array2[0], $array1[1]=>$array3[2]);
			    return json_encode($arr);

			}
			else
			{
			    reportErrorLog("Kullanıcı kaydı yapılırken sorun oluştu", 1013);
				$arr = array($array1[0]=>$array2[1], $array1[1]=>$array3[3]);
			    return json_encode($arr);
			}
		}
	}
	//#$conn->close();
}


//Formdan gönderilmiş olan verilerin boş olmadığından veya space karakteri ile dolu olmadığından emin olmak için.
function isNullorOnlySpace($userInput)
{
	if(is_null($userInput) or ctype_space($userInput))
	{
		return TRUE;
	}
	else
	{
		return FALSE;
	}
}

//Kullanıcı girişi yapmış kişinin ismini ve soyismini gönderir.
//kullanmadan önce isSessionActive() kullanmak gerekir, session yoksa problem çıkacaktır.
function getSessionDisplayName()
{
	return $_SESSION["firstName"]. " " .$_SESSION["lastName"];
}

//Kullanıcı girişi yapmış kişinin bakiyesini gönderir.
//kullanmadan önce isSessionActive() kullanmak gerekir, session yoksa problem çıkacaktır.
function getUserBalance()
{
	return $_SESSION["balance"]."₺";
}

//Kullanıcının yetki seviyesini gönderir
//Kullanmadan önce isSessionActive() kullanmak gerekir, session yok ise hata verecektir.
function getUserLevel()
{
	return (int)$_SESSION["userType"];
}


function getParks($city)
{
	global $conn;

	$parkArray = array();

	$sql = "SELECT Park.park_id, Park.parkName, Park.maxNumCars, Park.currentNumCars, Park.province_id, Province.province_name, Park.person_id, Person.firstName, Person.lastName, Province.city_id, City.city_name FROM Park INNER JOIN Person ON Park.person_id = Person.person_id INNER JOIN Province ON Park.province_id = Province.province_id INNER JOIN City ON Province.city_id = City.city_id WHERE City.city_id IN (SELECT slug_id FROM Slug WHERE slug_url = '$city')";

	$result = $conn->query($sql);
	if ($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			$parkArray = array_merge($parkArray, array(array($row["park_id"], $row["parkName"], $row["province_name"], $row["maxNumCars"], $row["currentNumCars"])));
		}
		return $parkArray;
	}
	else
	{
		reportErrorLog("getParks fonksiyonunda veri çekilirken sorun oluştu / veya daha otopark girilmemiş bir ile erişim sağlandı", 1015);
		return "Otopark Bulunamadı.";
		//redirectWithTimer("index"); //otopark bulunamadı yazısı olduğundan dolayı yenileme işlemi yapılmadı.
	}
	//#$conn->close();
}

//getParks'da kullanılmak üzere oluşturulmuş bir fonksiyondur, kullanıcıya db'deki değil, normal il adını göstermek içindir.
function getCityTitle($citySlugURL)
{
	global $conn;

	$sql = "SELECT slug_title FROM Slug WHERE slug_url = '$citySlugURL'";

	$result = $conn->query($sql);
	if ($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			return $row["slug_title"];
		}
	}
	else
	{
		echo "Verileri çekerken sorun oluştu. Geri yönlendiriliyorsunuz...";
		reportErrorLog("getCityTitle fonksiyonunda veri çekilirken sorun oluştu", 1010);
		redirectWithTimer("index");
	}
	//#$conn->close();
}


//getParks fonksiyonunda rezervasyon butonunun içerisine park'ın benzersiz linkini koyabilmek için.
function getParkTitle($parkId)
{
	global $conn;

	$sql = "SELECT Park.park_id, Park.slug_id, Slug.slug_id, Slug.slug_url FROM Park INNER JOIN Slug ON Park.slug_id = Slug.slug_id WHERE Park.park_id = '$parkId'";

	$result = $conn->query($sql);
	if ($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			return $row["slug_url"];
		}
	}
	else
	{
		echo "Verileri çekerken sorun oluştu. Geri yönlendiriliyorsunuz...";
		reportErrorLog("getParkTitle fonksiyonunda veri çekilirken sorun oluştu", 1016);
		redirectWithTimer("index");
	}
	//#$conn->close();
}


function userProfile($person_id)
{
	$profileArray = array();

	if(isSessionActive())
	{
		global $conn;

		$sql = "SELECT Person.firstName, Person.lastName, Person.phoneNo, Person.email, Person.city_id, User.balance, City.city_name FROM Person INNER JOIN User ON Person.person_id = User.person_id INNER JOIN City ON Person.city_id = City.city_id WHERE Person.person_id = '$person_id'";

		$result = $conn->query($sql);
		if ($result->num_rows > 0)
		{

			while($row = $result->fetch_assoc())
			{
				array_push($profileArray, $row["phoneNo"],$row["email"],$row["city_name"], $row["balance"], $row["lastName"], $row["firstName"]);
			}
			return $profileArray;
		}
		else
		{
			echo "Verileri çekerken sorun oluştu. Geri yönlendiriliyorsunuz...";
			reportErrorLog("User Profile verilerini çekerken sorun oluştu", 1008);
			redirectWithTimer("index");
		}
		//$conn->close(); //reservationHistory fonksiyonunda kapatıldı.
		//userProfile conn, 1 - getWehicles conn, 1 #opt 1010
	}
	else
	{
		reportErrorLog("userProfile fonksiyonunda session olmadan profil bilgileri çekilmeye çalışıldı / session bittikten sonra girilmeye çalışılmışta olabilir", 1009);
		destroyUserSession();
		redirectTo("index");
	}
}

function getWehicles($person_id)
{
	global $conn;
	$wehicles = array();

	$sql = "SELECT full_plate, is_main FROM Wehicle WHERE person_id = '$person_id'";

	$result = $conn->query($sql);
	if ($result->num_rows > 0)
	{

		while($row = $result->fetch_assoc())
		{
			//echo "Plaka: ". $row["full_plate"]."<br>";
			if((int)$row["is_main"] === 1)
			{
				array_push($wehicles, $row["full_plate"]." (Seçili)");
			}
			else
			{
				array_push($wehicles, $row["full_plate"]);
			}
		}
		return $wehicles;
	}
	else
	{
		/*reportErrorLog("getWehicles fonksiyonunda verileri çekerken sorun oluştu", 1022);
		echo "Verileri çekerken sorun oluştu. Geri yönlendiriliyorsunuz...";
		redirectWithTimer("index");*/
		return "Sisteme kayıtlı aracınız bulunmamaktadır.";
	}
	//$conn->close(); //tekrar gözden geçirilecek. #opt 1010
}


//Sistemde kullanıcıya ait araç olup olmadığını sorgular.
function numOfWehicles($person_id)
{
	global $conn;

	$sql = "SELECT full_plate FROM Wehicle WHERE person_id = '$person_id'";

		$result = $conn->query($sql);
		if ($result->num_rows > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
}


function reportAuth($userName, $firstName, $lastName, $person_id)
{
	$timezone=0;
	date_default_timezone_set('Europe/Istanbul');
	$get_time=date("Y/m/d h:i:s a", time() + 3600*($timezone+date("I")));
	$ip = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];

	global $conn;

	$sql = "INSERT INTO AuthLog (userName, firstName, lastName, authDate, ip, person_id) VALUES ('$userName','$firstName','$lastName','$get_time','$ip', '$person_id')";

	if (!($conn->query($sql) === TRUE))
	{
		reportErrorLog("ReportAuth AuthLog'a kayıt yaparken sorun oluştu", 1005);
	}

	//$conn->close(); //loginControl kendisi kapatacak connection'ı.

	//---------------------------------------------------------------------------------

	$to = "handlerrors@gmail.com";
	$subject = "Login";
	$message = "
	<html>
		<head>
			<meta charset=\"UTF-8\">
			<title>Error</title>
			<style>
				.alignTh
				{
					text-align:left;
					padding-right:4px;
				}
				.alignTd
				{

				}
			</style>
		</head>
	<body>
		<center>
		<p>Yetkili bir kişinin hesabına giriş yapıldı!</p>
			<table>
				<tr>
					<th class='alignTh'>Kullanıcı </th>
					<td class='alignTd'>".$userName."</td>
				</tr>
				<tr>
					<th class='alignTh'>İsim </th>
					<td class='alignTd'>".$firstName."</td>
				</tr>
				<tr>
					<th class='alignTh'>Soyisim: </th>
					<td class='alignTd'>".$lastName."</td>
				</tr>
				<tr>
					<th class='alignTh'>Tarih: </th>
					<td class='alignTd'>".reArrangeDate($get_time)."</td>
				</tr>
				<tr>
					<th class='alignTh'>ip: </th>
					<td class='alignTd'>".$ip."</td>
				</tr>
				<tr>
					<th class='alignTh'>Kişi id: </th>
					<td class='alignTd'>".$person_id."</td>
				</tr>
			</table>
		</center>
	</body>
	</html>
	";

	// HTML email için content-type
	$headers = "MIME-Version: 1.0" . "\r\n"; 
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

	//$headers .= "From: admin@epark.com" . "\r\n";
	$headers .= "From: Admin ePark <admin@epark.com>" . "\r\n";

	//mail($to, $subject, $message, $headers) or die();
	if(!mail($to, $subject, $message, $headers))
	{ 
		reportErrorLog("ReportAuth mail gönderiminde sorun oluştu", 1004);
	}
}


function reportErrorLog($message, $code)
{
	$timezone=0;
	date_default_timezone_set('Europe/Istanbul');
	$get_time=date("Y/m/d h:i:s a", time() + 3600*($timezone+date("I")));
	$ip = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];

	global $conn;

	$sql = "INSERT INTO ErrorLog (message, code, errorDate, ip) VALUES ('$message','$code','$get_time','$ip')";

	if ($conn->query($sql) === TRUE)
	{
		$sql2 = "SELECT error_id FROM ErrorLog ORDER BY error_id DESC LIMIT 1";
		$result = $conn->query($sql2);
		if ($result->num_rows > 0)
		{
			while($row = $result->fetch_assoc())
			{
				$errId = $row["error_id"];
			}
		}
	}
	else
	{
		//reportErrorLog("ReportErrorLog ErrorLog'a kayıt yaparken sorun oluştu", 1006);
		//sorun var ise kendisine geri döndürünce yine sorun oluşacaktır.
		//die(); // #opt 1160
		//die(); footerın yüklenmesini engellediğinden kaldırıldı.
	}


	//$conn->close();

	//---------------------------------------------------------------------------------


	$to = "handlerrors@gmail.com";
	//-----
	//DB bağlantı hatası vermesi durumunda hatayı engelleyebilmek için.
	if(isset($errId))
	{
		$subject = "Error ".$errId;
	}
	else
	{
		$subject = "Error x";
	}
	//----
	$message = "
	<html>
		<head>
			<meta charset=\"UTF-8\">
			<title>Error</title>
			<style>
				.alignTh
				{
					text-align:left;
					padding-right:4px;
				}
				.alignTd
				{

				}
			</style>
		</head>
	<body>
		<center>
		<p>Bir hata ile karşılaşıldı!</p>
			<table>
				<tr>
					<th class='alignTh'>Hata: </th>
					<td class='alignTd'>".$message."</td>
				</tr>
				<tr>
					<th class='alignTh'>Hata Kodu: </th>
					<td class='alignTd'>".$code."</td>
				</tr>
				<tr>
					<th class='alignTh'>Tarih: </th>
					<td class='alignTd'>".reArrangeDate($get_time)."</td>
				</tr>
				<tr>
					<th class='alignTh'>ip: </th>
					<td class='alignTd'>".$ip."</td>
				</tr>
			</table>
		</center>
	</body>
	</html>
	";

	// HTML email için content-type
	$headers = "MIME-Version: 1.0" . "\r\n"; 
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

	//$headers .= "From: admin@epark.com" . "\r\n";
	$headers .= "From: Admin ePark <admin@epark.com>" . "\r\n";

	//mail($to, $subject, $message, $headers) or die();
	if(!mail($to, $subject, $message, $headers))
	{ 
		//echo 'Email has sent successfully.';
		//suppress;
	}
}


function dbFeedback()
{
	$timezone=0;
	date_default_timezone_set('Europe/Istanbul');
	$get_time=date("Y/m/d h:i:s a", time() + 3600*($timezone+date("I")));
	$spcDate = date("Y-m-d");

	global $conn;

	$sql = "INSERT INTO dbFeedback (fbDate) VALUES ('$get_time')";


	if (!($conn->query($sql) === TRUE))
	{
		reportErrorLog("dbFeedback fonksiyonunda yeni tarih için insert yapılırken sorun oluştu", 1019);
	}


	//$conn->close(); // refreshDB.php kapattıracak connection'ı.

	//---------------------------------------------------------------------------------


	$to = "handlerrors@gmail.com";
	$subject = $spcDate." Tarihli DB Yenilemesi";
	$message = "
		<html>
		<head>
			<meta charset=\"UTF-8\">
			<title>DB Yenilemesi</title>
			<style>
			</style>
		</head>
	<body>
		<center>
		<br><br>
		<p>DB ".reArrangeDate($get_time)." tarihi için yenilendi.</p>
		</center>
	</body>
	</html>
	";

	// HTML email için content-type
	$headers = "MIME-Version: 1.0" . "\r\n"; 
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";


	$headers .= "From: Admin ePark <admin@epark.com>" . "\r\n";

	if(!mail($to, $subject, $message, $headers))
	{ 
		reportErrorLog("dbFeedback fonksiyonunda mail gönderiminde sorun oluştu", 1018);
	}
}

//rezervasyon sayfasındaki detaylı listelemek için verileri gönderir.
function getParkDetails($parkSlugURL)
{
	$timezone = 0;
	date_default_timezone_set('Europe/Istanbul');
	$get_time = date("Y-m-d");
	$localD = date("d");
	$localL = date("l");
	$localF = date("F");

	$parkArray = array();

	global $conn;

	$sql = "SELECT Slug.slug_title, Slug.slug_id, Park.maxNumCars, Park.currentNumCars, parkStatus.h12, parkStatus.h13, parkStatus.h14, parkStatus.h15, parkStatus.h16, parkStatus.h17, parkStatus.h18, parkStatus.h19, parkStatus.h20, parkStatus.h21, parkStatus.h22, parkStatus.h23, parkStatus.h00, parkStatus.h01, parkStatus.h02, parkStatus.h03, parkStatus.h04, parkStatus.h05, parkStatus.h06, parkStatus.h07, parkStatus.h08, parkStatus.h09, parkStatus.h10, parkStatus.h11, parkStatus.recDate FROM Slug INNER JOIN Park ON Slug.slug_id = Park.slug_id INNER JOIN parkStatus ON Park.park_id = parkStatus.park_id WHERE slug_url = '$parkSlugURL' AND recDate = '$get_time'";

	$result = $conn->query($sql);
	if ($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			array_push($parkArray,$row["h00"],$row["h01"],$row["h02"],$row["h03"],$row["h04"],$row["h05"],$row["h06"],$row["h07"],$row["h08"],$row["h09"],$row["h10"],$row["h11"],$row["h12"],$row["h13"],$row["h14"],$row["h15"],$row["h16"],$row["h17"],$row["h18"],$row["h19"],$row["h20"],$row["h21"],$row["h22"],$row["h23"]);
			array_push($parkArray,$row["slug_title"],$row["maxNumCars"],$row["currentNumCars"],$localD, $localL, $localF);
		}
		return $parkArray;
	}
	else
	{
		echo "Verileri çekerken sorun oluştu. Geri yönlendiriliyorsunuz...";
		reportErrorLog("getParkDetails fonksiyonunda veri çekilirken sorun oluştu", 1017);
		redirectWithTimer("index"); //otopark bulunamadı yazısı olduğundan dolayı yenileme işlemi yapılmadı.
	}
	//#$conn->close();
}


//Gönderilmiş olan rezervasyon saati dolu ise onu vurgular.
function parkDetailCheckBox($parkStatus, $time)
{
	$timezone=0;
	date_default_timezone_set('Europe/Istanbul');
	$now = date("H"); //24 saat formatı çünkü db'de rezervasyon saatleri ve parkStatus 24 saatlik dilimde tutuluyor.

	if($parkStatus === "BOŞ")
	{
		if((int)$now > (int)$time) {
			return "<input type=\"checkbox\" value=\"".$time."\" name=\"time[]\" disabled>"; //gönderildiği yer echo'da olduğundan echo değil, return kullanıldı.
		} else {
			return "<input type=\"checkbox\" value=\"".$time."\" name=\"time[]\">"; //gönderildiği yer echo'da olduğundan echo değil, return kullanıldı.
	}
	}
	else
	{
		return "<span class=\"color2\">DOLU</span>";
	}
}

function returnCarImg($parkStatus)
{
	if($parkStatus === "BOŞ")
	{
		return "<img src=\"" .isDevelopmentModeOn(). "images/car-green.png\" class=\"parkReservationCarImg\">";
	}
	else
	{
		return "<img src=\"" .isDevelopmentModeOn(). "images/car-red.png\" class=\"parkReservationCarImg\">";
	}
}

//include 'htmlStart.php'; , 'functions.php' veya getHeader(); satırlarından sonra eklenmelidir.
//Kllanıcı girişi gerektiren sayfalarda, giriş yapılmamış ise login sayfasına yönlendirir.
function pageProtection()
{
	if(!isSessionActive())
	{
		session_unset();
		session_destroy();
		redirectTo("login");
	}
}

/*Önce kullanıcılar için rezervasyon geçmişi için kayıt tutar, daha sonra ilgili park için
*güncelleme yapar.
*/
function completeReservation($park_url, $arrayTime, $person_id)
{
	$getTime = array();
	$getTime = explode(",", $arrayTime);

	$array1 = array();
	array_push($array1, "status");
	array_push($array1, "message");

	$array2 = array();
	array_push($array2,"success");
	array_push($array2,"failed");

	$timezone=0;
	date_default_timezone_set('Europe/Istanbul');
	$spcDate = date("Y-m-d");

	$balance = currentBalance($person_id);
	$parkFee = calculateParkFee(parkIdForReservation($park_url), count($getTime));
	if(!($balance - $parkFee < 0)) {
		$pStatusId = parkStatusIdForReservation($park_url);
		//echo $pStatusId; //test

		global $conn;

		for($i = 0; $i < count($getTime); $i++)
		{
			$sql = "INSERT INTO Reservation (reservation_hour, reservation_date, full_plate, person_id, parkStatus_id) VALUES ('$getTime[$i]','$spcDate', (SELECT full_plate FROM Wehicle WHERE is_main = 1 AND person_id = '$person_id'), '$person_id', '$pStatusId')";

			if (!($conn->query($sql) === TRUE))
			{
				reportErrorLog("completeReservation fonksiyonunda saatleri tek tek girerken sorun oluştu", 1023);
				endSession();
				$arr = array($array1[0]=>$array2[1], $array1[1]=>"Hata oluştu");
				return json_encode($arr);
			}
		}



		$splitTime = "";

		for($i = 0; $i < count($getTime); $i++)
		{
			$temp = "parkStatus.h";
			$temp = $temp . substr($getTime[$i], 0, 2); //start, length

			$splitTime = $splitTime . $temp . "='$person_id', ";
		}

		$splitTime = substr($splitTime, 0, (strlen($splitTime) - 2));
		//echo $splitTime; //test

		$sql = "UPDATE parkStatus INNER JOIN Park ON parkStatus.park_id = Park.park_id INNER JOIN Slug ON Park.slug_id = Slug.slug_id SET ".$splitTime." WHERE Slug.slug_url = '$park_url' AND parkStatus.recDate = '$spcDate'";
		//echo $sql; //test for query.

		if (!($conn->query($sql) === TRUE))
		{
			reportErrorLog("completeReservation fonksiyonunda parkStatus için saatleri güncellerken sorun oluştu", 1024);
			endSession();
			$arr = array($array1[0]=>$array2[1], $array1[1]=>"Hata oluştu");
			return json_encode($arr);
		}



		$sql = "UPDATE User INNER JOIN Person ON User.person_id = Person.person_id SET User.balance = (User.balance - '$parkFee') WHERE Person.person_id = '$person_id'";
		if (!($conn->query($sql) === TRUE && renewSession($person_id) === TRUE)) {
			reportErrorLog("completeReservation fonksiyonunda balance güncellerken sorun oluştu", 1045);
			endSession();
			$arr = array($array1[0]=>$array2[1], $array1[1]=>"Hata oluştu");
			return json_encode($arr);
		}

		//redirectTo("cities");
		$arr = array($array1[0]=>$array2[0], $array1[1]=>"Rezervasyon gerçekleştirildi");
		return json_encode($arr);
	} else {
		//echo "yeterli bakiyeniz bulunmamakta.";
		$arr = array($array1[0]=>$array2[1], $array1[1]=>"Yeterli bakiyeniz bulunmamakta");
		return json_encode($arr);
	}
}


//completeReservation fonksiyonunda günlük park kayıtlarının tutulduğu tabloya veri göndermek için.
function parkStatusIdForReservation($park_url)
{
	$timezone=0;
	date_default_timezone_set('Europe/Istanbul');
	$spcDate = date("Y-m-d");

	global $conn;

	$sql = "SELECT parkStatus.parkStatus_id FROM parkStatus INNER JOIN Park ON parkStatus.park_id = Park.park_id INNER JOIN Slug ON Park.slug_id = Slug.slug_id WHERE Slug.slug_url = '$park_url' AND parkStatus.recDate = '$spcDate'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			$val = $row["parkStatus_id"];
		}
		return $val;
	}
	else
	{
		reportErrorLog("parkStatusIdForReservation fonksiyonunda veri çekilirken sorun oluştu", 1025);
	}
	//$conn->close(); //connection completeReservation fonksiyonu içerisinde kapatılacak.
}

function parkIdForReservation($park_url) {
	global $conn;

	$get = "park_id";
	$query = "SELECT Park.park_id FROM Park INNER JOIN Slug ON Park.slug_id = Slug.slug_id WHERE Slug.slug_url = '$park_url'";

	$data = basicSelectQueries($query, $get);
	if(is_array($data)) {
		return $data[0];
	}

	// Alternatif SQL
	/*$sql = "SELECT Park.park_id FROM Park INNER JOIN Slug ON Park.slug_id = Slug.slug_id WHERE Slug.slug_url = '$park_url'";
	echo $sql."<br>";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc())
			$val = $row["park_id"];
		return $val;
	}
	else
		reportErrorLog("parkIdForReservation fonksiyonunda veri çekilirken sorun oluştu", 1043);*/
}

function calculateParkFee($park_id, $hour) {
	global $conn;

	$hr = $hour;
	if($hr > 12)
		$hr = "12h_plus";
	else
		$hr = $hr. "hr";

	$get = $hr;
	$query = "SELECT " .$get. " FROM parkFee WHERE park_id = '$park_id'";

	$data = basicSelectQueries($query, $get);
	if(is_array($data)) {
		return $data[0];
	}

	// Alternatif SQL
	/*$sql = "SELECT " .$hr. " FROM parkFee WHERE park_id = '$park_id'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc())
			$val = $row[$hr];
		return $val;
	}
	else
		reportErrorLog("calculateParkFee fonksiyonunda veri çekilirken sorun oluştu", 1044);*/
}

function currentBalance($person_id) {
	global $conn;

	$get = "balance";
	$query = "SELECT " .$get. " FROM User WHERE person_id = '$person_id'";

	$data = basicSelectQueries($query, $get);
	if(is_array($data)) {
		return $data[0];
	}
}


//Profilde rezervasyon geçmişini göstermek için kişinin bilgilerini gönderir.
function reservationHistory($person_id)
{
	$timezone=0;
	date_default_timezone_set('Europe/Istanbul');
	$spcDate = date("Y-m-d"); //date("d.m.Y");

	$history = array();

	global $conn;

	$sql = "SELECT Reservation.reservation_hour, Reservation.reservation_date, Reservation.full_plate, Slug.slug_title FROM Reservation INNER JOIN parkStatus ON Reservation.parkStatus_id = parkStatus.parkStatus_id INNER JOIN Park ON parkStatus.park_id = Park.park_id INNER JOIN Slug ON Park.slug_id = Slug.slug_id WHERE Reservation.person_id = '$person_id' ORDER BY Reservation.reservation_date DESC, Reservation.reservation_id DESC, Reservation.reservation_hour ASC LIMIT 10";
	$result = $conn->query($sql);
	if ($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			$history = array_merge($history, array(array($row["slug_title"], $row["reservation_hour"], reArrangeDate($row["reservation_date"]), $row["full_plate"])));
		}
		return $history;
	}
	else
	{
		return "Rezervasyon geçmişiniz bulunmamaktadır.";
		//reportErrorLog("Rezervasyon geçmişi bulunamadı.", 1026);
	}
	//#$conn->close(); // userProfile'dan sonra kullanılıyor.
}


#Örnek olarak 2020-02-01 (yıl, tarih, gün) olan tarihi 01-02-2020 (gün, ay, tarih) formatına çevirir.
function reArrangeDate($date)
{
	$newType = "";
	$newType = substr($date, 8, 2); // başlangıç, length
	$newType = $newType .".". substr($date, 5, 2);
	$newType = $newType .".". substr($date, 0, 4);
	return $newType;
}


//Otoparkçı için kendisine ait olan otoparkın günlük raporlarını listeler
function reportList($person_id)
{
	$timezone=0;
	date_default_timezone_set('Europe/Istanbul');
	$currentMonth = date("m");
	$currentYear = date("Y");

	$list = array();

	global $conn;

	//SELECT recDate FROM parkStatus WHERE MONTH(recDate) = 03 AND YEAR(recDate) = 2020 ORDER BY DAY(recDate) DESC;
	$sql = "SELECT parkStatus.recDate FROM parkStatus INNER JOIN Park ON Park.park_id = parkStatus.park_id INNER JOIN Person ON Park.person_id = Person.person_id WHERE Park.person_id = '$person_id' AND MONTH(parkStatus.recDate)='$currentMonth' AND YEAR(parkStatus.recDate)='$currentYear' ORDER BY DAY(parkStatus.recDate) DESC";
	$result = $conn->query($sql);
	if ($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			$list = array_merge($list, array($row["recDate"]));
		}

		$sql2 = "SELECT Slug.slug_title FROM Park INNER JOIN Slug ON Park.slug_id = Slug.slug_id WHERE person_id = '$person_id'";
		$result2 = $conn->query($sql2);
		if ($result2->num_rows > 0) {
			while($row = $result2->fetch_assoc()) {
				$list = array_merge($list, array($row["slug_title"]));
			}
		} else {
			reportErrorLog("reportList fonksiyonunda park adını çekerken sorun oluştu.", 1038);
			return "Park Adı Bulunamadı.";
		}

		return $list;
	}
	else
	{
		reportErrorLog("reportList fonksiyonunda verileri çekerken sorun oluştu.", 1028);
		return "Park Detayları bulunamadı.";
		//redirectWithTimer("index");
	}
	//#$conn->close();
}


/*Park raporları için detay kısmı, hangi saatte boş veya kim rezervasyon yapmış onun bilgilerini gönderir. rezervasyon yapmış olan kişinin person_id'sini göndererek ileride işlem yaptırılmasını sağlar.
*/
function parkHistory($person_id, $date)
{
	$timezone=0;
	date_default_timezone_set('Europe/Istanbul');
	$spcDate = date("Y-m-d"); //date("d.m.Y");

	$details = array();

	global $conn;

	$sql = "SELECT Park.maxNumCars, Park.currentNumCars, Park.parkName, parkStatus.parkStatus_id, parkStatus.recDate, parkStatus.h12, parkStatus.h13, parkStatus.h14, parkStatus.h15, parkStatus.h16, parkStatus.h17, parkStatus.h18, parkStatus.h19, parkStatus.h20, parkStatus.h21, parkStatus.h22, parkStatus.h23, parkStatus.h00, parkStatus.h01, parkStatus.h02, parkStatus.h03, parkStatus.h04, parkStatus.h05, parkStatus.h06, parkStatus.h07, parkStatus.h08, parkStatus.h09, parkStatus.h10, parkStatus.h11 FROM Park INNER JOIN parkStatus ON Park.park_id = parkStatus.park_id INNER JOIN Person ON Park.person_id = Person.person_id WHERE Park.person_id = '$person_id' AND parkStatus.recDate = '$date' ORDER BY parkStatus.recDate DESC";
	$result = $conn->query($sql);
	if ($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			$details = array_merge($details, array($row["h00"],$row["h01"],$row["h02"],$row["h03"],$row["h04"],$row["h05"],$row["h06"],$row["h07"],$row["h08"],$row["h09"],$row["h10"],$row["h11"],$row["h12"],$row["h13"],$row["h14"],$row["h15"],$row["h16"],$row["h17"],$row["h18"],$row["h19"],$row["h20"],$row["h21"],$row["h22"],$row["h23"], $row["parkName"], $date, $row["parkStatus_id"]));

		}
		return $details;
	}
	else
	{
		reportErrorLog("parkHistory fonksiyonunda verileri çekerken sorun oluştu.", 1027);
		return "Park Detayları bulunamadı.";
		//redirectWithTimer("index");
	}
	//#$conn->close();
}

/*Park raporları günlük listelendiğinde, o gün yapılmış olan rezervasyonları saat,park ve tarih olarak eşleştirerek o parka rezervasyon yaptırmış olan kişinin bilgilerini çeker.
*/
function parkHistoryPersonFilter($person_id, $date, $hour, $statusId)
{
	$timezone=0;
	date_default_timezone_set('Europe/Istanbul');

	$personDetails = array();

	global $conn;

	$sql = "SELECT Reservation.full_plate, Person.firstName, Person.lastName FROM Reservation INNER JOIN Person ON Reservation.person_id = Person.person_id WHERE Reservation.person_id = '$person_id' AND Reservation.reservation_date = '$date' AND Reservation.reservation_hour = '$hour' AND Reservation.parkStatus_id = '$statusId'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			array_push($personDetails, $row["firstName"], $row["lastName"], $row["full_plate"]);
		}
		return $personDetails;
	}
	else
	{
		reportErrorLog("parkHistoryPersonFilter fonksiyonunda verileri çekerken sorun oluştu.", 1029);
		return "Park Detayları bulunamadı.";
		//redirectWithTimer("index");
	}
	//#$conn->close();
}


//Park sahibi mi diye kontrol eder, yetkilendirme sayfaları için kullanılmakta. (örnek olarak records.php)
function isParkOwner()
{
	if(!getUserLevel() === 1)
	{
		destroyUserSession();
	}
}


//Dinamik js kaynak yönlendirme fonksiyonu
function jsSource()
{
	$jsArray = array();

	$jsLink1 = isDevelopmentModeOn()."JS/JSFile.js";
	$jsLink2 = isDevelopmentModeOn()."JS/prod.js";
	$jsSrc1 = "<script src=\"".$jsLink1."\"></script>";
	$jsSrc2 = "<script src=\"".$jsLink2."\"></script>";

	array_push($jsArray, $jsSrc1, $jsSrc2);

	return $jsArray;
}


//Dinamik css kaynak yönlendirme fonksiyonu
function cssSource()
{
	$cssArray = array();

	$cssLink1 = isDevelopmentModeOn()."CSS/CSSFile.css";
	$cssLink2 = isDevelopmentModeOn()."CSS/prod.css";
	$cssHref1 = "<link rel=\"stylesheet\" type=\"text/css\" href=\"".$cssLink1."\"/>";
	$cssHref2 = "<link rel=\"stylesheet\" type=\"text/css\" href=\"".$cssLink2."\"/>";

	array_push($cssArray, $cssHref1, $cssHref2);

	return $cssArray;
}

//Dinamik css kaynak yönlendirme fonksiyonu - ikincil tasarım için
function extCssSource()
{
	$cssArray = array();

	$cssLink1 = isDevelopmentModeOn()."CSS/style.css";
	$cssLink2 = isDevelopmentModeOn()."CSS/all.css";
	$cssHref1 = "<link rel=\"stylesheet\" type=\"text/css\" href=\"".$cssLink1."\"/>";
	$cssHref2 = "<link rel=\"stylesheet\" type=\"text/css\" href=\"".$cssLink2."\"/>";

	array_push($cssArray, $cssHref1, $cssHref2);

	return $cssArray;
}

function print_js_or_css($givenSourceArray)
{
	$genArray = array();
	$genArray = $givenSourceArray;

    for($i = 0; $i < count($genArray); $i++)
    {
        echo $genArray[$i];
    }
}


//Basit select sorguları için dinamik fonksiyon. Tek veri döndüren queryler için çalışıyor.
function basicSelectQueries($query, $selection)
{
	global $conn;

	$sql = $query;

	$result = $conn->query($sql);
	if ($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			return array($row[$selection]);
		}
	}
	else
	{
		reportErrorLog("basicSelectQueries fonksiyonunda verileri çekerken sorun oluştu. <br> işlenmeye çalışan veri örneği;<br>" .$query. "<br>" .$selection, 1031);
		return false;
	}
}


//Siteye girildiğinde bakım modunda olup olmadığını kontrol eder, bakım modu 1 ise bakım sayfasına yönlendirilir. (diğer sayfalara erişim kesilir)
function maintenanceMode()
{
	$get = "setting_value";
	$query = "SELECT ".$get." FROM Settings WHERE setting_name = 'bakim_durumu'";

	$data = basicSelectQueries($query, $get);
	if(is_array($data) and (int)$data[0] === 1)
	{
		redirectTo("maintenance");
	}
}


//Database bağlantısını kapatmak için dinamik yöntem
function closeConn()
{
	global $conn;
	//unset($conn);
	$conn->close();

}

function vDay_tr($day)
{
	$days_tr = array("Pazar", "Pazartesi", "Salı", "Çarşamba", "Perşembe", "Cuma", "Cumartesi");
	$days_en = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");

	return $days_tr[array_search($day, $days_en)];
}

function vMon_tr($mon)
{
	$mos_tr = array("Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık");
	$mos_en = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");

	return $mos_tr[array_search($mon, $mos_en)];
}

function personCity($person_id)
{
	$get = "city_id";
	$query = "SELECT ".$get." FROM Person WHERE person_id = '$person_id'";

	$data = basicSelectQueries($query, $get);

	return $data[0];
}

function updateUserProfile($query, $person_id)
{
	$array1 = array();
	array_push($array1, "status");
	array_push($array1, "message");

	$array2 = array();
	array_push($array2,"success");
	array_push($array2,"failed");

	global $conn;

	$sql = "UPDATE Person, User SET " .$query. " WHERE Person.person_id='$person_id' AND User.person_id='$person_id'";

	if ($conn->query($sql) === TRUE && renewSession($person_id) === TRUE)
	{
		$arr = array($array1[0]=>$array2[0], $array1[1]=>"Profiliniz güncellendi");
	    return json_encode($arr);
	}
	else
	{
		reportErrorLog("updateUserProfile fonksiyonunda verileri güncellerken sorun oluştu", 1030);

		$arr = array($array1[0]=>$array2[1], $array1[1]=>"Profili güncellerken sorun oluştu");
	    return json_encode($arr);
	}
}

function getServerSettings() {
	global $conn;
	$dataArray = array();

	$sql = "SELECT setting_id, setting_name, setting_value FROM Settings";
	$result = $conn->query($sql);
	if ($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			$dataArray = array_merge($dataArray, array(array($row["setting_id"], $row["setting_name"], $row["setting_value"])));
		}
		return $dataArray;
	}
	else
	{
		reportErrorLog("getServerSettings fonksiyonunda verileri çekerken sorun oluştu.", 1032);
		return "Park Detayları bulunamadı.";
	}
}


function renewSession($person_id) {
	global $conn;

	$sql = "SELECT Person.firstName, Person.lastName, Person.email, User.balance FROM Person INNER JOIN User ON Person.person_id = User.person_id WHERE Person.person_id = '$person_id'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			//session_start(); var olan session değerleri değiştiriliyor sadece.
			$_SESSION["firstName"] = $row["firstName"];
			$_SESSION["lastName"] = $row["lastName"];
			$_SESSION["email"] = $row["email"];
			$_SESSION["balance"] = $row["balance"];
		}
		return true;
	} else {
		reportErrorLog("renewSession fonksiyonunda session yenilenirken sorun oluştu", 1033);
		return false;
	}
}

function generateToken() {
	global $conn;

	$result = 1;
	$i = 0;

	while($result > 0) {
		$token = "";
		for($i = 0; $i < 60; $i++) {
			$token = $token. "" .strval(rand(1,9));
		}

		$sql = "SELECT token FROM Tokens WHERE token='$token'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			continue;
		}
		else {
			break;
		}
		$i++;
	}
	
	return $token;
}


function sendToken($email) {
	$array1 = array();
	array_push($array1, "status");
	array_push($array1, "message");

	$array2 = array();
	array_push($array2,"success");
	array_push($array2,"failed");

	global $conn;

	$getEmail = $conn->real_escape_string($_POST["email"]); // data js tarafından temizlenerek gelse de yine de escape string ile kontrol edilecek.
	$token = generateToken();
	$timezone=0;
	date_default_timezone_set('Europe/Istanbul');
	$spcDate = date("Y-m-d");
	$spcTime = date("H:i:sa"); // 24 saat dilimi ile girilip 12saat dilimi olarak çekilecek.
	$baseURL = "http://epark.sinemakulup.com/password/change/token=";
	$devURL = "http://epark.sinemakulup.com/external/tkeskin/password/change/token=";
	$baseProt = "http://epark.sinemakulup.com/password/protection/token=";
	$devProt = "http://epark.sinemakulup.com/external/tkeskin/password/protection/token=";

	$sql1 = "SELECT email FROM Person WHERE email='$getEmail'";
	$result1 = $conn->query($sql1);
	if ($result1->num_rows > 0) { // eğer böyle bir email sistemde kayıtlı ise
		$sql2 = "INSERT INTO Tokens (email, token, tokenDate, tokenTime) VALUES ('$getEmail', '$token', '$spcDate', '$spcTime')";
		if ($conn->query($sql2) === TRUE) {

			$to = $email;
			$subject = "Şifre Değiştirme Talebi";
			$message = "
				<html>
				<head>
					<meta charset=\"UTF-8\">
					<title>Şifre Değiştirme Talebi</title>
					<style>
					</style>
				</head>
			<body>
				<br><br>
				<p> ".reArrangeDate($spcDate)." tarihinde şifrenizin değiştirilmesi için talep oluşturuldu.
					<br><br>
					Şifrenizi değiştirebilmeniz için linkiniz: " .$baseURL. "" .$token.
					"<br><br><br>
					Eğer bu mail sizin tarafınızdan gönderilmedi ise <a href=\"" .$baseProt. "" .$token. "\">buraya</a> tıklayınız.
				</p>
			</body>
			</html>
			";

			// HTML email için content-type
			$headers = "MIME-Version: 1.0" . "\r\n"; 
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

			$headers .= "From: ePark <admin@epark.com>" . "\r\n";

			if(mail($to, $subject, $message, $headers)) { 
				$arr = array($array1[0]=>$array2[0], $array1[1]=>"Link eposta adresinize gönderildi.");
			    return json_encode($arr);
			} else {
				reportErrorLog("sendToken fonksiyonunda kişiye email gönderilirken sorun oluştu.", 1034);
				$arr = array($array1[0]=>$array2[1], $array1[1]=>"Link eposta adresinize gönderilirken sorun oluştu.");
		    	return json_encode($arr);
			}
		} else {
			reportErrorLog("sendToken fonksiyonunda kişiye token oluşturulurken sorun oluştu.", 1036);

			$arr = array($array1[0]=>$array2[1], $array1[1]=>"Link eposta adresinize gönderilirken sorun oluştu.");
		    return json_encode($arr);
		}
	} else {
		reportErrorLog("sendToken fonksiyonunda kişinin girdiği email db'de bulunamadı veya çekilemedi - bu kontrol geçici olabilir.", 1035);
		$arr = array($array1[0]=>$array2[1], $array1[1]=>"Sistemde girilen email'e ait kayıt bulunamadı.");
	    return json_encode($arr);
	}
}

function tokenValidation($token) {
	$timezone=0;
	date_default_timezone_set('Europe/Istanbul');

	global $conn;
	$dataArray = Array();

	$sql = "SELECT token_id, email, token, tokenDate, TIME_FORMAT(tokenTime, '%r') as tokenTime, is_valid FROM Tokens WHERE token='$token'";

	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			if((int)$row["is_valid"] === 1) {
				array_push($dataArray, $row["token_id"], $row["token"], $row["tokenDate"], $row["tokenTime"], $row["is_valid"]);

				return $dataArray;
			} else {
				return "Bu link artık kullanılamıyor gibi görünüyor!";
			}
		}
	} else {
		reportErrorLog("tokenValidation fonksiyonunda aranan token bulunamadı veya hiç bulunmamakta.", 1037);
		return "Böyle bir link bulunmamakta.";
	}
}

function tokenSession($token_id, $tokenDate, $tokenTime) {
	$timezone=0;
	date_default_timezone_set('Europe/Istanbul');
	$today = date("Y-m-d");
	$now = strtoupper(date("h:i:s a")); // sondaki 12 saat dilimi için AM/PM büyük gösterilmesi için strtoupper kullanıldı.

	//echo "<br><br>Şuan: " .$now. "<br>Token zamanı: " .$tokenTime;

	// Mevcut zaman için yapılan zaman işlemi.
	$nowExt = substr($now, strlen($now) - 2, 2); // AM/PM çekiliyor.
	$now = substr($now, 0, strlen($now) - 3); // Sondaki AM/PM siliniyor.

	// hh:mm:ss formatında kalan ham zaman
	//print_r(explode(":", $now));
	$nowArray = explode(":", $now); // zaman : dan ayrılıyor.
	$nowSec = $nowArray[2]; // saniye ayrıştırılıyor.
	$nowMin = $nowArray[1]; // dakika ayrıştırılıyor.
	$nowH = $nowArray[0]; // saat ayrıştırılıyor.

	$nDay = date("d"); // mevcut gün
	$nMon = date("m"); // mevcut ay
	$nY = date("Y"); // mevcut yıl


	// Token için yapılan zaman işlemi
	$tokenExt = substr($tokenTime, strlen($tokenTime) - 2, 2); // AM/PM çekiliyor.
	$tokenTime = substr($tokenTime, 0, strlen($tokenTime) - 3); // Sondaki AM/PM siliniyor.

	// hh:mm:ss formatında kalan ham zaman
	//print_r(explode(":", $tokenTime));
	$tokenArray = explode(":", $tokenTime); // zaman : dan ayrılıyor.
	$tokenSec = $tokenArray[2]; // saniye ayrıştırılıyor.
	$tokenMin = $tokenArray[1]; // dakika ayrıştırılıyor.
	$tokenH = $tokenArray[0]; // saat ayrıştırılıyor.

	$tokenDateArray = explode("-", $tokenDate);
	$tDay = $tokenDateArray[2]; // token'ın oluşturulduğu gün
	$tMon = $tokenDateArray[1]; // token'ın oluşturulduğu ay
	$tY = $tokenDateArray[0]; // token'ın oluşturulduğu yıl.



	/*echo "<br><br>Şuan:<br>" .$nowH. "<br>" .$nowMin. "<br>" .$nowSec. "<br>" .$nowExt. "<hr>" .$nDay. "<br>" .$nMon. "<br>" .$nY;
	echo "<br><br>Token:<br>" .$tokenH. "<br>" .$tokenMin. "<br>" .$tokenSec. "<br>" .$tokenExt. "<hr>" .$tDay. "<br>" .$tMon. "<br>" .$tY;*/


	//echo "<br><br><br><br>";
	$nowSum = ($nMon * 30 * 24 * 60) + ($nDay * 24 * 60) + ($nowH * 60) + $nowMin;
	$tokenSum = ($tMon * 30 * 24 * 60) + ($tDay * 24 * 60)+ ($tokenH * 60) + $tokenMin;
	//echo "Şuan: " .$nowSum. "<br>";
	//echo "Token: " .$tokenSum;

	// aynı yıl içerisinde mi diye kontrol ediliyor.
	if($nY === $tY) {
		if(!($nowSum < $tokenSum) && ($nowSum > $tokenSum && $nowSum < ($tokenSum + 16))) {
			return true; // 15dk içerisinde ise.
		} else {
			global $conn;
			$sql = "UPDATE Tokens SET is_valid=0 WHERE token_id='$token_id'";
			if(!($conn->query($sql) === TRUE)) {
				reportErrorLog("tokenSession fonksiyonunda is_valid=0 yapılırken sorun oluştu", 1041);
			}
			return false; // 15dk içerisinde değil ise.
		}
	} else {
		return false; //aynı yıl içerisinde olmuyor ise
		/* yaşanabilecek tek sorun yılın son gününde ve son 15dk içerisinde yapılabilecek bir şifre değiştirme talebinde, yeni yıla girilmesi durumunda linki deaktif olacak. */
	}
}

function updatePass($sessionTokenId, $password) {
	$array1 = array();
	array_push($array1, "status");
	array_push($array1, "message");

	$array2 = array();
	array_push($array2,"success");
	array_push($array2,"failed");

	$password = convertPassToMD5($password);
	global $conn;

	$sql1 = "UPDATE Tokens SET is_valid=0 WHERE token_id='$sessionTokenId'";
	if($conn->query($sql1) === TRUE) {
		$sql2 = "UPDATE User INNER JOIN Person ON User.person_id = Person.person_id SET User.userPassword='$password' WHERE Person.email=(SELECT email FROM Tokens WHERE token_id='$sessionTokenId')";
		if ($conn->query($sql2) === TRUE) {
			endSession();
			$arr = array($array1[0]=>$array2[0], $array1[1]=>"Şifreniz Güncellendi");
		    return json_encode($arr);
		} else {
			reportErrorLog("updatePass fonksiyonunda şifre güncellenirken hata oluştu.", 1040);
			endSession(); //token session'ı sonlandırılıyor.
			$arr = array($array1[0]=>$array2[1], $array1[1]=>"Şifre güncellenirken sorun oluştu");
	    	return json_encode($arr);
		}
	} else {
		reportErrorLog("updatePass fonksiyonunda is_valid 0 yapılırken hata oluştu.", 1039);
		endSession(); //token session'ı sonlandırılıyor.
		$arr = array($array1[0]=>$array2[1], $array1[1]=>"Şifre güncellenirken sorun oluştu");
		return json_encode($arr);
	}
}

function removeToken($token) {
	$timezone=0;
	date_default_timezone_set('Europe/Istanbul');
	$get_time=date("Y/m/d h:i:s a", time() + 3600*($timezone+date("I")));
	$ip = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
	global $conn;

	$sql = "UPDATE Tokens SET is_valid=0 WHERE token='$token'";
	if($conn->query($sql) === TRUE) {
		return true;
	} else {
		reportErrorLog("removeToken fonksiyonunda is_valid 0 yapılırken hata oluştu.", 1042);
		return false;
	}
}

// Regular Expressions
//--------------------------------------------------------------------------------
// ^ ile başlıyor
// $ ile bitiyor
// + 1 veya daha fazla
// {3} tane
// \ özel karakter engelleme -> :// için \:\/\/ mecburi
// noktalar [.] veya \. şeklinde
// | veya

function urlRE($url){
	$pattern = "/^(https\:\/\/|http\:\/\/){1}w{3}[.]{1}[a-zA-Z][a-zA-Z0-9]+[.]{1}[a-z]+$/";
	//$val = "https://www.test01.com";
	if(preg_match_all($pattern, $url)) {
		return true;
	} else {
		return false;
	}
}

function mailRE($mail){
	$pattern = "/^([a-z])([a-zA-Z0-9])+\@{1}[a-z]+[.]{1}[a-z]+$/"; //başta küçük harf ile başlayıp sonda da bir veya daha fazla küçük harf ile bitmeli
	//$val2 = "test@gmail.com";
	if(preg_match_all($pattern, $mail)) {
		return true;
	} else {
		return false;
	}
}
//--------------------------------------------------------------------------------

// OOP test alanı. Yeni gelecek metodlar için testler devam edecek.
function oopSelect() {
	$query = "SELECT firstName, lastName FROM Person LIMIT 4";
	//$data = "firstName,lastName";
	$data = "firstName, lastName";

	$obj = new Dbpro($query, $data);
	/*getData = $obj->rselect();

	echo $getData. "<br><br>";
	print_r($getData);*/


	echo "<br><br><br><br>";

	$getData = $obj->mSelect();
	if(is_array($getData)) {
		echo $getData. "<br><br>";
		print_r($getData);
	} else {
		echo $getData;
	}


	echo "<br><br><br><br>";

	$getData = $obj->Select();
	if(is_array($getData)) {
		echo $getData. "<br><br>";
		print_r($getData);
	} else {
		echo $getData;
	}
}

// Aynı başlangıca sahip sayfalara dinamik olarak title ekler
function srchTitle($title) {
	switch($title) {
		case 'index':
			return "<title>E-Park Sistemi</title>";
		case 'gizlilik-politikasi':
			return "<title>Gizlilik Politikası</title>";
		case 'otoparkimiz-ol':
			return "<title>Otoparkımız Ol</title>";
		default:
			return "<title>E-Park</title>"; // olur da sayfa tanımlanamaz ise.
	}
}

// Farklı yapılmış sayfalara dinamik start ve title vermek için (sayfa adı girilince title'ı yazdırılıyor)
function includeExtContents($page) {
    define("TITLE", srchTitle($page));
    include_once('include/bs-include/start.php');
}






?>
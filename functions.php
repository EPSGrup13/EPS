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
//-------------------------------------------------------------------



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
		die("Bu sayfaya direk erişim yapamazsınız!");
		redirectWithTimer("index");
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

//Yönlendirilecek sayfalara zaman ekler. Kullanımı redirectTo ile aynı.
//Mevcut durumda hatalı üye girişi, 404 vb. sayfalarda kullanılmakta.
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
			//output testi
			//echo $row["userName"] . " " . $row["userPassword"] . " " . $row["userType"] . " " . $row["userStatus"] . " " . $row["balance"] . " " . $row["firstName"] . " " . $row["lastName"] . " " . $row["email"];

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
			redirectTo("index");
			//redirectTo("external/tkeskin/");
		}
	}
	else
	{
		echo "Giriş bilgileri doğru değil. Geri Yönlendiriliyorsunuz...";
		redirectWithTimer("login");
		
		/*
		echo "<br><br><a href=\"login?goBack\">Geri Dön</a>";
		if(isset($_GET["goBack"]))
		{
			redirectTo("index");
		}
		*/
	}
	$conn->close();
}

function getAllCities()
{
	global $conn;

	$sql = "SELECT City.city_id, Slug.slug_title, Slug.slug_url FROM City INNER JOIN Slug ON City.slug_id = Slug.slug_id";
	$result = $conn->query($sql);
	if ($result->num_rows > 0)
	{
		echo "<div class=\"cityFrame\">";
		while($row = $result->fetch_assoc())
		{

			echo "<div class=\"city\">";
				echo "<div class=\"cityNum\">".$row["city_id"]."</div>";
				echo "<div class=\"cityName\"><a href=\"".isDevelopmentModeOn()."".$row["slug_url"]."/parklar\">".$row["slug_title"]."</a></div>";
			echo "</div>";

		}
		echo "</div>";
	}
	else
	{
		reportErrorLog("getAllCities fonksiyonunda veri çekilirken sorun oluştu", 1012);
		echo "Verileri çekerken sorun oluştu."; //bu sayfa direk index olduğundan redirect yapılmayacak.
		//redirectWithTimer("index");
	}
	$conn->close();
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
			    //echo "Error: " . $sql1 . " and ". $sql2 . "<br>" . $conn->error;
				reportErrorLog("Kullanıcı kaydı yapılırken sorun oluştu", 1013);
				echo "Kayıt oluşturulurken sorun oluştu. Geri yönlendiriliyorsunuz...";
				redirectWithTimer("index");
			}
		}
	}
	$conn->close();
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

	echo getCityTitle($city)." otoparkları: <br><br>";

	$sql = "SELECT Park.park_id, Park.parkName, Park.maxNumCars, Park.currentNumCars, Park.province_id, Province.province_name, Park.person_id, Person.firstName, Person.lastName, Province.city_id, City.city_name FROM Park INNER JOIN Person ON Park.person_id = Person.person_id INNER JOIN Province ON Park.province_id = Province.province_id INNER JOIN City ON Province.city_id = City.city_id WHERE City.city_id IN (SELECT slug_id FROM Slug WHERE slug_url = '$city')";

	$result = $conn->query($sql);
	if ($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			//echo "Park id: ".$row["park_id"]. "<br>";
			$parkId = $row["park_id"];
			echo "Park : ".$row["parkName"]. "<br>"; //Park Adı
			//echo "Maksimum Araç Sayısı: ".$row["maxNumCars"]. "<br>";
			//echo "Mevcut Araç Sayısı: ".$row["currentNumCars"]. "<br>";
			//echo "İlçe id: ".$row["province_id"]. "<br>";
			echo "İlçe : ".$row["province_name"]. "<br>"; //İlçe Adı
			//echo "Park Sahibi id: ".$row["person_id"]. "<br>";
			//echo "Park Sahibi: ".$row["firstName"]." ".$row["lastName"]. "<br>";
			//echo "İl id: ".$row["city_id"]. "<br>";
			//echo "İl Adı: ".$row["city_name"]. "<br>";

			//maksimum araç sayısı - mevcut araç sayısı = boş yer sayısı.
			$availablePark = (int)$row["maxNumCars"] - (int)$row["currentNumCars"];
			if($availablePark == 0) //boş yer yok ise kırmızı dolu, var ise sayısını yeşil yazdırır.
			{
				echo "Park <span class=\"color2\">dolu</span>";
			}
			else
			{
				echo "Boş yer sayısı: <span class=\"color1\">".$availablePark."</span><br>";
				echo "<a href=\"".isDevelopmentModeOn()."rezervasyon/".getParkTitle($parkId)."\">Rezervasyon Yap</a>";

			}
			echo "<br><br><br>";
		}
	}
	else
	{
		echo "Otopark Bulunamadı.";
		reportErrorLog("getParks fonksiyonunda veri çekilirken sorun oluştu / veya daha otopark girilmemiş bir ile erişim sağlandı", 1015);
		//redirectWithTimer("index"); //otopark bulunamadı yazısı olduğundan dolayı yenileme işlemi yapılmadı.
	}
	$conn->close();
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
		reportErrorLog("getCityTitle fonksiyonunda veri çekilirken sorun oluştu", 1010);
		echo "Verileri çekerken sorun oluştu. Geri yönlendiriliyorsunuz...";
		redirectWithTimer("index");
	}
	$conn->close();
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
		reportErrorLog("getParkTitle fonksiyonunda veri çekilirken sorun oluştu", 1016);
		echo "Verileri çekerken sorun oluştu. Geri yönlendiriliyorsunuz...";
		redirectWithTimer("index");
	}
	$conn->close();
}


function userProfile($person_id)
{
	if(isSessionActive())
	{
		global $conn;

		$sql = "SELECT Person.firstName, Person.lastName, Person.phoneNo, Person.email, Person.city_id, User.balance, City.city_name FROM Person INNER JOIN User ON Person.person_id = User.person_id INNER JOIN City ON Person.city_id = City.city_id WHERE Person.person_id = '$person_id'";

		$result = $conn->query($sql);
		if ($result->num_rows > 0)
		{

			while($row = $result->fetch_assoc())
			{
				echo "İsim: ". $row["firstName"]."<br>";
				echo "Soyisim: ". $row["lastName"]."<br>";
				echo "Telefon No: ". $row["phoneNo"]."<br>";
				echo "Email: ". $row["email"]."<br>";
				//echo "İl id: ". $row["city_id"]."<br>";
				echo "Bakiye: ". $row["balance"]."<br>";
				echo "İl: ". $row["city_name"]."<br>";

				echo "<br>";

			}
			//print_r(getWehicles($person_id));
			$wehiclesArray = getWehicles($person_id);
			$lenWehiclesArray = count($wehiclesArray);
			for($i = 0; $i < $lenWehiclesArray; $i++)
			{
				echo "Plaka: ".$wehiclesArray[$i]."<br>";
			}
		}
		else
		{
			reportErrorLog("User Profile verilerini çekerken sorun oluştu", 1008);
			echo "Verileri çekerken sorun oluştu. Geri yönlendiriliyorsunuz...";
			redirectWithTimer("index");
		}
		$conn->close();
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

	$sql = "SELECT full_plate FROM Wehicle WHERE person_id = '$person_id'";

	$result = $conn->query($sql);
	if ($result->num_rows > 0)
	{

		while($row = $result->fetch_assoc())
		{
			//echo "Plaka: ". $row["full_plate"]."<br>";
			array_push($wehicles, $row["full_plate"]);
		}
	}
	else
	{
		reportErrorLog("getWehicles fonksiyonunda verileri çekerken sorun oluştu", 1022);
		echo "Verileri çekerken sorun oluştu. Geri yönlendiriliyorsunuz...";
		redirectWithTimer("index");
	}
	$conn->close(); //tekrar gözden geçirilecek.
	return $wehicles;
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
					<td class='alignTd'>".$get_time."</td>
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

	// Always set content-type when sending HTML email
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
		$sql2 = "SELECT error_id FROM ErrorLog ORDER BY error_id DESC LIMIT 1;";
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
		reportErrorLog("ReportErrorLog ErrorLog'a kayıt yaparken sorun oluştu", 1006);
	}


	$conn->close();

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
					<td class='alignTd'>".$get_time."</td>
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
	$spcDate = $get_time = date("Y-m-d");

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
		<p>DB ".$get_time." tarihi için yenilendi.</p>
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


function getParkDetails($parkSlugURL)
{
	$timezone = 0;
	date_default_timezone_set('Europe/Istanbul');
	$get_time = date("Y-m-d");
	$localDateType = date("d l");

	$parkArray = array();

	global $conn;

	$sql = "SELECT Slug.slug_title, Slug.slug_id, Park.maxNumCars, Park.currentNumCars, parkStatus.h12, parkStatus.h13, parkStatus.h14, parkStatus.h15, parkStatus.h16, parkStatus.h17, parkStatus.h18, parkStatus.h19, parkStatus.h20, parkStatus.h21, parkStatus.h22, parkStatus.h23, parkStatus.h00, parkStatus.h01, parkStatus.h02, parkStatus.h03, parkStatus.h04, parkStatus.h05, parkStatus.h06, parkStatus.h07, parkStatus.h08, parkStatus.h09, parkStatus.h10, parkStatus.h11, parkStatus.recDate FROM Slug INNER JOIN Park ON Slug.slug_id = Park.slug_id INNER JOIN parkStatus ON Park.park_id = parkStatus.park_id WHERE slug_url = '$parkSlugURL' AND recDate = '$get_time'";

	$result = $conn->query($sql);
	if ($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			//echo "Park Adı: ". $row["slug_title"]."<br>";

			//maksimum araç sayısı - mevcut araç sayısı = boş yer sayısı.
			$availablePark = (int)$row["maxNumCars"] - (int)$row["currentNumCars"];
			if($availablePark == 0) //boş yer yok ise kırmızı dolu, var ise sayısını yeşil yazdırır.
			{
				//echo "Park <span class=\"color2\">dolu</span>";
			}
			else
			{
				//echo "Boş yer sayısı: <span class=\"color1\">".$availablePark."</span><br>";

			}
			//echo "Tarih: ".$localDateType."<br>";

			array_push($parkArray,$row["h01"],$row["h02"],$row["h03"],$row["h04"],$row["h05"],$row["h06"],$row["h07"],$row["h08"],$row["h09"],$row["h10"],$row["h11"],$row["h12"],$row["h13"],$row["h14"],$row["h15"],$row["h16"],$row["h17"],$row["h18"],$row["h19"],$row["h20"],$row["h21"],$row["h22"],$row["h23"],$row["h00"]);
			array_push($parkArray,$row["slug_title"],$row["maxNumCars"],$row["currentNumCars"],$localDateType);

			//echo "<br><br><br>";
		}
	}
	else
	{
		reportErrorLog("getParkDetails fonksiyonunda veri çekilirken sorun oluştu", 1017);
		echo "Verileri çekerken sorun oluştu. Geri yönlendiriliyorsunuz...";
		redirectWithTimer("index"); //otopark bulunamadı yazısı olduğundan dolayı yenileme işlemi yapılmadı.
	}
	$conn->close();
	return $parkArray;
}


function parkDetailCheckBox($parkStatus, $time)
{
	if($parkStatus === "BOŞ")
	{
		return "<input type=\"checkbox\" value=\"".$time."\" name=\"time[]\"></div>"; //gönderildiği yer echo'da olduğundan echo değil, return kullanıldı.
	}
	else
	{
		return "<span class=\"color2\">DOLU</span></div>";
	}
}





?>
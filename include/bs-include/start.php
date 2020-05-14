<?php
    include_once(__DIR__ . '/../functions.php'); // üst klsörde __DIR__ ve /
    checkDirectAccessToIncludeFile();
?>

<!DOCTYPE html>
<html lang="tr">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <!-- initial-scale mobil yakınlaştırma izin verme -->
    <meta name="language" content="Turkish">
    <!-- SEO için Meta Etiketleri -->
    <meta name="description"
        content="İstanbul'un Farklı Bölgelerinde en uygun fiyata E-Park ile park et. Ücretsiz mobil uygulama.Tüm Otoparklar Cebinde">
    <meta name="keywords" content="Park,E-Park,Otopark,Online Park,Ücretsiz Park">
    <meta name="author" content="EPS">
    <meta http-equiv="Content-Type" content="text/html; charset=utf8">
    <meta name="robots" content="index, follow">

    <base href="http://epark.sinemakulup.com">
    <?php
        if(defined("TITLE")) {
            echo constant("TITLE");
        } else {
            echo "<title>E-Park</title>";
        }
    ?>
    <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
    <?php cssSourceSelection("CSSFile", "all", "style"); ?>
    <link rel="icon" href="/images/logo-icon.png">
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.0.min.js"></script>
</head>
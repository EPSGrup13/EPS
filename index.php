<?php
    include_once('functions.php');
    session_start();
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
    <title>E-Park Sistemi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="/CSS/all.css">
    <link rel="stylesheet" href="/CSS/style.css">
    <link rel="icon" href="/images/logo-icon.png">
</head>

<body>
    <!--
    <div class="clr" id="ust-menu">
        <a class="marka" href="index.html" style="text-decoration: none;">
            <h3 class="proje-isim">e-park</h3>
        </a></div>
-->
    <div class="menu" style="float: right;">
        <div class="mobil-menu"><i class="fa fa-bars fa-2x" aria-hidden="true" style="color: white;"></i></div>
        <ul style="float: right;">

            <li><a href="<?php echo isDevelopmentModeOn(); ?>">Anasayfa</a></li>

            <li><a href="<?php echo isDevelopmentModeOn(); ?>cities">Rezervasyon Yap</a></li>

            <li><a href="javascript:void(0)">Nerelerdeyiz</a></li>

            <li><a href="#">Otoparkımız Ol</a></li>

            <li><a href="<?php echo isDevelopmentModeOn(); ?>contact">İletişim</a></li>

            <li><a href="#">Giriş Yap</a></li>

        </ul>
    </div>

    <!-- Header -->
    <header id="baslik" class="baslik">
        <div class="baslik-icerik">
            <div class="container">
                <div class="col-lg-6">
                    <div class="container">
                        <h1 style="color: white;">E-PARK SİSTEMİ ile <br> Rezervasyon yaptığın otoparka detaylı yol
                            tarifi al, park yerini
                            aramakla vakit kaybetme.
                            <br>
                            <span style="font-size: 1.5rem;">Nişantaşı’ndan Kadıköy’e Bebek’ten Bağdat Caddesi’ne
                                çevrendeki tüm otoparkları
                                <br> E-Park ile gör!
                            </span></h1>
                        <p class="p-aciklama">E-Park mobil uygulaması her yerde rahatça ve kolayca park yeri
                            bulabilmeniz için geliştirildi.</p>
                        <a class="buton" href="---------------.ipa"><i class="fab fa-apple"></i> İos da mevcut değil</a>
                        <a class="buton" href="---------------.apk"><i class="fab fa-google-play"></i> Google
                            Play İndirin</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header Bitiş -->


    <div id="" class="ozellikler-bolumu">
        <div class="container">
            <div>
                <div class="col-lg-12">
                    <h2 style="color: white;">ÖZELLİKLER</h2>
                    <div class="p-aciklama" style="text-align: center;">E-Park kullanarak neler yapabilirsin?
                    </div>
                </div> <!-- col bitiş bs-->
            </div>
            <div class="row">
                <!-- row bs -->
                <ul class="nav-tabs" id="" role="tablist">
                    <!-- nav bs -->
                    <li class="nav-item">
                        <a class="nav-link active" id=""><i class="fas fa-cog"></i> ÖZELLİKLER</a>
                    </li>
                </ul>


                <div class="tab-content">
                    <!-- tab bs -->
                    <div class="ozellikler" id="ozellik-1">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="deneme">
                                        <div class="sol-bolum">
                                            <div class="yazi-aciklama">
                                                <h4 class="konu">Otoparkları İncele</h4>
                                                <p class="ozellikler-p">Anlaşmalı otoparkların fiyat ve konum
                                                    bilgilerini incele</p>
                                            </div>
                                            <div class="simge">
                                                <i class="fas fa-search"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sol-bolum">
                                        <div class="bosluk">
                                            <div class="yazi-aciklama">
                                                <h4 class="konu">Rezervasyon Yap</h4>
                                                <p class="ozellikler-p">Otoparka gideceğin saati belirleyerek yerini
                                                    önceden ayır</p>
                                            </div>
                                            <div class="simge">
                                                <i class="fas fa-car"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sol-bolum">
                                        <div class="bosluk">
                                            <div class="yazi-aciklama">
                                                <h4 class="konu">Yol Tarifi Al</h4>
                                                <p class="ozellikler-p">Rezervasyon yaptığın otoparka detaylı yol tarifi
                                                    al</p>
                                            </div>
                                            <div class="simge">
                                                <i class="far fa-compass"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Mobil Arayüz Görseli -->
                                <div class="col-lg-4">
                                    <img class="mobil-arayuz-jpg" src="https://i.imgyukle.com/2020/02/21/nBOh1A.jpg"
                                        alt="E-Park Mobil Arayüz">
                                </div>
                                <!-- Mobil Arayüz Görseli -->


                                <div class="col-lg-4">
                                    <div class="sag-bolum">
                                        <div class="bosluk">
                                            <div class="simge">
                                                <i class="fas fa-coins"></i>
                                            </div>
                                            <div class="yazi-aciklama">
                                                <h4 class="konu">İndirimli Park Et</h4>
                                                <p class="ozellikler-p">Rezervasyon yaparak indirimli fiyatlar ile park
                                                    et</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sag-bolum">
                                        <div class="bosluk">
                                            <div class="simge">
                                                <i class="far fa-credit-card"></i>
                                            </div>
                                            <div class="yazi-aciklama">
                                                <h4 class="konu">Kredi Kartınla Öde</h4>
                                                <p class="ozellikler-p">Otopark ücretini mobil uygulama üzerinden yap,
                                                    otoparka hiçbir ücret ödeme</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sag-bolum">
                                        <div class="bosluk">
                                            <div class="simge">
                                                <i class="fas fa-phone"></i>
                                            </div>
                                            <div class="yazi-aciklama">
                                                <h4 class="konu">Bize Ulaşın</h4>
                                                <p class="ozellikler-p">EPS Mobil Uygulama ile ilgili geri dönüşlerinizi
                                                    buradan
                                                    yapabilirsiniz.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <div class="container">
            <!-- container bs -->
            <div>
                <div class="col-md-12">
                    <div class="footer-boy">
                        <h4 class="col-md-10" style="text-align: right;" style="text-align: left;">EPS</h4>
                        <p class="col-md-12" style="text-align: right;" style="text-align: left;">Ayazağa, Hadım
                            Koruyolu Cd. No:19, 34398 Sarıyer/İSTANBUL</p>
                        <ul>
                            <li><a rel="external" href="javascript:void(0)"><span
                                        class="fab fa-facebook-f fa-lg"></span></a></li>
                            <li><a target="self" href="javascript:void(0)"><span
                                        class="fab fa-twitter fa-lg"></span></a></li>
                            <li><a target="_blank" href="javascript:void(0)"><span
                                        class="fab fa-google-play fa-lg"></span></a></li>
                        </ul>
                        </p>
                        <p>
                            <div>
                                <ul>
                                    <li><a href="javascript:void(0)">Şartlar ve Koşullar</a></li>
                                    <li><a href="javascript:void(0)">Hakkımızda</a></li>
                                    <li><a href="javascript:void(0)">Gizlilik Politikası</a></li>
                                    <li><a href="javascript:void(0)">İndir</a></li>
                                </ul>
                            </div>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="copyright-bolumu">
        <div class="container">
            <div>
                <div class="col-lg-12">
                    <p class="p-small">Copyright © 2020. EPS </p>
                </div>
            </div>
        </div>
    </div>

    <article>
        <p class="yukari-buton"></p>
    </article>
        
    <?php echo jsSource(); ?>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="JS/jquery-3.4.1.min.map"></script>
    <script src="JS/yukari-buton.js"></script>
    <script>
        window.onload = YeniSekme;
        
        $(function () {
            $(".mobil-menu").click(function () {
                $(this).next("ul").toggle(200);
            });
        });
    </script>
    
</body>

</html>

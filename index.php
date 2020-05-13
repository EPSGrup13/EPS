<?php
    define('LOADED', TRUE);
    include_once('include/functions.php');
    session_start();

    includeExtContents("index");
?>

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

            <li><a href="<?php echo isDevelopmentModeOn(); ?>otoparkimiz-ol">Otoparkımız Ol</a></li>

            <li><a href="<?php echo isDevelopmentModeOn(); ?>contact">İletişim</a></li>

            <?php
                if(isSessionActive())
                {
                    echo "<li><a href=\"".isDevelopmentModeOn()."settings/profile\">Profil</a></li>";
                }
                else
                {
                    echo "<li><a href=\"".isDevelopmentModeOn()."login\"><i class=\"fas fa-sign-in-alt\"></i> Giriş yap</a></li>";
                }
            ?>

        </ul>
                <div class="ust-menu-logo">

            <a href="http://epark.sinemakulup.com/"><img src="/images/logo.png" alt="EPS LOGO" /> <a class="marka"
                    href="index.html" style="text-decoration: none;">
                </a>
                </div>
    </div>

    <!-- Header -->
    <header id="baslik" class="baslik">
        <div class="baslik-icerik">
            <div class="container">
                <div class="col-lg-6" style="margin-top: -60px;">
                    <div class="container">
                        <h1 style="color: white;">E-PARK ile <br> Uygun durumdaki otoparkları gör,
                            online olarak yerini al,
                            park yeri aramakla vaktini harcama.
                            <br>
                            <span style="font-size: 1.5rem;">İstanbul’dan Ankara'ya İzmir’den Antalya’ya
                                Türkiye'nin tüm şehir ve ilçelerinde yerini
                                <br> E-Park ile gör!
                            </span></h1>
                        <p class="p-aciklama">Türkiye'nin her tarafındaki anlaşmalı olduğumuz otoparklara
                        tek tık ile rezervasyon yap.</p>
<!--                    <a class="buton" href="---------------.ipa"><i class="fab fa-apple"></i> App Store'da mevcut değil</a> -->
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
                    <div class="p-aciklama" style="text-align: center;">E-Park ile neler yapabilirsin?
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
                                                <h4 class="konu">Otoparkları Gör</h4>
                                                <p class="ozellikler-p">EPS Otoparklarının konumlarını, ücretini
                                                    ve puanlarını gör</p>
                                            </div>
                                            <div class="simge">
                                                <i class="fas fa-search"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sol-bolum">
                                        <div class="bosluk">
                                            <div class="yazi-aciklama">
                                                <h4 class="konu">Yerini Ayır</h4>
                                                <p class="ozellikler-p">Seçtiğin otoparka istediğin saatte rezervasyon yap</p>
                                            </div>
                                            <div class="simge">
                                                <i class="fas fa-car"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sol-bolum">
                                        <div class="bosluk">
                                            <div class="yazi-aciklama">
                                                <h4 class="konu">Navigasyon Hizmeti</h4>
                                                <p class="ozellikler-p">Çevrendeki en yakın otoparkı gör veya istediğin otoparka doğru
                                                    rotanı belirle</p>
                                            </div>
                                            <div class="simge">
                                                <i class="fas fa-location-arrow"></i>
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
                                                <i class="fas fa-hourglass-half"></i>
                                            </div>
                                            <div class="yazi-aciklama">
                                                <h4 class="konu">Zaman Kazan</h4>
                                                <p class="ozellikler-p">Park yeri aramakla vaktini harcama
                                                 zaman kazan</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sag-bolum">
                                        <div class="bosluk">
                                            <div class="simge">
                                                <i class="far fa-credit-card"></i>
                                            </div>
                                            <div class="yazi-aciklama">
                                                <h4 class="konu">Kart İle Ödeme Yap</h4>
                                                <p class="ozellikler-p">Otopark ücretini kredi kartı ya da banka kartın ile
                                                    hızlı ve güvenli şekilde online öde</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sag-bolum">
                                        <div class="bosluk">
                                            <div class="simge">
                                                <i class="fas fa-phone"></i>
                                            </div>
                                            <div class="yazi-aciklama">
                                                <h4 class="konu">İletişime Geç</h4>
                                                <p class="ozellikler-p">İnternet sitemizin veya mobil uygulamamızın
                                                    iletişim bölümünden
                                                    bize ulaş</p>
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

    <?php include_once('include/bs-include/footer.php') ;?>

    <article>
        <p class="yukari-buton"></p>
    </article>
        
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <?php jsSourceSelection(); ?>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="JS/jquery-3.4.1.min.map"></script>
    <script src="JS/JScript.js"></script>


<?php include_once('include/bs-include/end.php'); ?>
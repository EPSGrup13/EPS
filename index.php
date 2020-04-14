<?php
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
                    echo "<li><a href=\"".isDevelopmentModeOn()."login\">Giriş yap</a></li>";
                }
            ?>

        </ul>
    </div>

    <!-- Header -->
    <header id="baslik" class="baslik">
        <div class="baslik-icerik">
            <div class="container">
                <div class="col-lg-6" style="margin-top: -60px;">
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
                        <a class="buton" href="---------------.ipa"><i class="fab fa-apple"></i> App Store'da mevcut değil</a>
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

    <?php include_once('include/bs-include/footer.php') ;?>

    <article>
        <p class="yukari-buton"></p>
    </article>
        
    <?php
        print_js_or_css(jsSource());
    ?>
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

<?php include_once('include/bs-include/end.php'); ?>
<?php
	define('LOADED', TRUE);
	include 'htmlStart.php';
	getHeader();
?>

<body>
    <nav>
        <ul>
            <div><a href="giris.html"><img src="https://i.hizliresim.com/oyQbo2.png" id="logo"/></a></div>
            <li><a href="giris.html">Anasayfa</a></li>
            <li><a href="#">Rezervasyon Yap</a></li>
            <li><a href="#">Nerelerdeyiz</a></li>
            <li><a href="iletisim.html">İletişim</a></li>
            <li style="position:absolute; right:220px;"><div class="dropdown">
                <button class="dropbtn">Merve Mor</button>
                <div class="dropdown-content">
                <a href="profilim.html">Profilim</a>
                <a href="#">Ayarlar</a>
                </div>
              </div>
            </li>
            <li style="position: absolute; right: 100px; top: 13px; color:white;">Bakiye:100.00₺</li>
            <li style="float:right;"><div class="dropdown">
                <button class="dropbtn">Çıkış Yap</button>
                </div>
              </div>
            </li>
        </ul>
    </nav>
    <p style="color: white; text-align: center; font-family:tahoma,arial; font-size:20px;">Bulunduğunuz şehri seçiniz</p>
    <table id="tablegiris" style="position: absolute; left: 120px; top: 100px; background-color: rgba(163, 69, 124, 0.452);">
        <tr>
            <td><a href="#">1 Adana</a></td>
            <td><a href="#">2 Adıyaman</a></td>
            <td><a href="#">3 Afyon</a></td>
            <td><a href="#">4 Ağrı</a></td>
            <td><a href="#">5 Amasya</a></td>
            <td><a href="#">6 Ankara</a></td>
            <td><a href="#">7 Antalya</a></td>
            <td><a href="#">8 Artvin</a></td>
            <td><a href="#">9 Aydın</a></td>
        </tr>

        <tr>
            <td><a href="#">10 Balıkesir</a></td>
            <td><a href="#">11 Bilecik</a></td>
            <td><a href="#">12 Bingöl</a></td>
            <td><a href="#">13 Bitlis</a></td>
            <td><a href="#">14 Bolu</a></td>
            <td><a href="#">15 Burdur</a></td>
            <td><a href="#">16 Bursa</a></td>
            <td><a href="#">17 Çanakkale</a></td>
            <td><a href="#">18 Çankırı</a></td>
        </tr>

        <tr>
            <td><a href="#">19 Çorum</a></td>
            <td><a href="#">20 Denizli</a></td>
            <td><a href="#">21 Diyarbakır</a></td>
            <td><a href="#">22 Edirne</a></td>
            <td><a href="#">23 Elazığ</a></td>
            <td><a href="#">24 Erzincan</a></td>
            <td><a href="#">25 Erzurum</a></td>
            <td><a href="#">26 Eskişehir</a></td>
            <td><a href="#">27 Gaziantep</a></td>
        </tr>

        <tr>
            <td><a href="#">28 Giresun</a></td>
            <td><a href="#">29 Gümüşhane</a></td>
            <td><a href="#">30 Hakkari</a></td>
            <td><a href="#">31 Hatay</a></td>
            <td><a href="#">32 Isparta</a></td>
            <td><a href="#">33 Mersin</a></td>
            <td><a href="#">34 İstanbul</a></td>
            <td><a href="#">35 İzmir</a></td>
            <td><a href="#">36 Kars</a></td>
        </tr>

        <tr>
            <td><a href="#">37 Kastamonu</a></td>
            <td><a href="#">38 Kayseri</a></td>
            <td><a href="#">39 Kırklareli</a></td>
            <td><a href="#">40 Kırşehir</a></td>
            <td><a href="#">41 Kocaeli</a></td>
            <td><a href="#">42 Konya</a></td>
            <td><a href="#">43 Kütahya</a></td>
            <td><a href="#">44 Malatya</a></td>
            <td><a href="#">45 Manisa</a></td>
        </tr>

        <tr>
            <td><a href="#">46 Kahramanmaraş</a></td>
            <td><a href="#">47 Mardin</a></td>
            <td><a href="#">48 Muğla</a></td>
            <td><a href="#">49 Muş</a></td>
            <td><a href="#">50 Nevşehir</a></td>
            <td><a href="#">51 Niğde</a></td>
            <td><a href="#">52 Ordu</a></td>
            <td><a href="#">53 Rize</a></td>
            <td><a href="#">54 Sakarya</a></td>
        </tr>

        <tr>
            <td><a href="#">55 Samsun</a></td>
            <td><a href="#">56 Siirt</a></td>
            <td><a href="#">57 Sinop</a></td>
            <td><a href="#">58 Sivas</a></td>
            <td><a href="#">59 Tekirdağ</a></td>
            <td><a href="#">60 Tokat</a></td>
            <td><a href="#">61 Trabzon</a></td>
            <td><a href="#">62 Tunceli</a></td>
            <td><a href="#">63 Şanlıurfa</a></td>
        </tr>

        <tr>
            <td><a href="#">64 Uşak</a></td>
            <td><a href="#">65 Van</a></td>
            <td><a href="#">66 Yozgat</a></td>
            <td><a href="#">67 Zonguldak</a></td>
            <td><a href="#">68 Aksaray</a></td>
            <td><a href="#">69 Bayburt</a></td>
            <td><a href="#">70 Karaman</a></td>
            <td><a href="#">71 Kırıkkale</a></td>
            <td><a href="#">72 Batman</a></td>
        </tr>

        <tr>
            <td><a href="#">73 Şırnak</a></td>
            <td><a href="#">74 Bartın</a></td>
            <td><a href="#">75 Ardahan</a></td>
            <td><a href="#">76 Iğdır</a></td>
            <td><a href="#">77 Yalova</a></td>
            <td><a href="#">78 Karabük</a></td>
            <td><a href="#">79 Kilis</a></td>
            <td><a href="#">80 Osmaniye</a></td>
            <td><a href="#">81 Düzce</a></td>
        </tr>
    
    <footer>
        <p>Copyright © 2019 - 2020 epark.com | Tüm hakları saklıdır</p>
        <div id="app"><a href="#"><img src="https://i.hizliresim.com/0rVv8Y.png" style="width: 110px; height: 40px;"/></a></div>   
    </footer>


</body>


<?php
	getFooter();
	getHtmlEnd();
?>
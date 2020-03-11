<?php
	define('LOADED', TRUE);
	include 'htmlStart.php';
	getHeader();
	pageProtection();
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
            </li>
        </ul>
    </nav>
<div id="formkapsamprofilim">
       <div class="profilimkullanicifoto">
       <img src="https://i.hizliresim.com/p7PP6q.png" style="width: 180px; height: 180px; position: absolute; left: 10px; top: 10px;">
        <div style="position:absolute; top:195px; left: 60px;"><p>Merve Mor</p><a href="#"><img src="https://i.hizliresim.com/agyN64.png" class="profilimkullanicismiguncelleme"/></a></div>
       </div>
    <div class="profilimrezervasyonlarımdiv">
        <div class="profilimrezervasyonlarımicdiv">
            <div class="profilimrezervasyonlarımyazisi">Rezervasyonlarım</div>
        </div>
    </div>

    <div class="profilimbilgilerdiv">
        <div class="profilimaracbilgileridiv">
            <div class="profilimaracbilgileriyazisi">Araç Bilgileri</div>
        </div>
        <a href="#"><img src="https://i.hizliresim.com/agyN64.png" class="profilimduzenlemeimg" style="top: 4px; left: 360px;"/></a>
        <p style="padding-left: 5px;">Plaka: 34ABC003</p>
        <p style="padding-left: 5px;">Araç Tipi: Motorsiklet</p>
        <div class="profilimiletisimbilgilerdiv">
            <div class="profilimiletisimbilgileryazisi">İletişim Bilgileri</div>
        </div>
        <a href="#"><img src="https://i.hizliresim.com/agyN64.png" class="profilimduzenlemeimg" style="top: 130px; left: 360px;"/></a>
        <p style="padding-left: 5px;">Telefon No: 05301250927</p>
        <p style="padding-left: 5px;">Email: merve.mor@hotmail.com</p>
        <p style="padding-left: 5px;">Bakiye: 100.00₺ </p>
        <a href="#"><img src="https://i.hizliresim.com/LGYRJa.png" class="profilimduzenlemeimg" style="top: 248px; left: 124px;"/></a>  
    </div>
      <div class="profilimpaneldiv">
        <div class="profilimpanelicdiv">
            <div class="profilimpanelyazisi">Panel</div>
        </div>
        <p><a href="eskirezervasyonlarim.html" class="profilimpanelsecenekleri">Eski Rezervasyonlarım</a></p>
        <p><a href="odemelerim.html" class="profilimpanelsecenekleri">Ödemelerim</a></p>
        <p><a href="faturalarim.html" class="profilimpanelsecenekleri">Faturalarım</a></p>
        <p><a href="yorumlarim.html" class="profilimpanelsecenekleri">Yorumlarım</a></p>
    </div> 
    <div class="profilimyeniaracdiv">
        <p class="profilimyeniaracekleyazisi">Yeni Araç Ekle</p>
        <a href="#"><img src="https://i.hizliresim.com/PCeHt1.png" class="profilimyeniaracekleimg"/></a>
    </div>
</div>
    <footer>
        <p>Copyright © 2019 - 2020 epark.com | Tüm hakları saklıdır</p>
        <div id="app"><a href="#"><img src="https://i.hizliresim.com/0rVv8Y.png" style="width: 110px; height: 40px;"/></a></div>   
    </footer>
</body>


<?php
	getFooter();
	getHtmlEnd();
?>
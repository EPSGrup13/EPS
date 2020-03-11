<?php
	define('LOADED', TRUE);
	include 'htmlStart.php';
	getHeader();
?>

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
    
    
    <footer>
        <p>Copyright © 2019 - 2020 epark.com | Tüm hakları saklıdır</p>
        <div id="app"><a href="#"><img src="https://i.hizliresim.com/0rVv8Y.png" style="width: 110px; height: 40px;"/></a></div>   
    </footer>


<?php
	getFooter();
	getHtmlEnd();
?>
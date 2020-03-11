<?php
	define('LOADED', TRUE);
	include  'htmlStart.php';
	maintenanceMode(); //header olmadığından ek olarak eklendi.
	session_start();
?>

<body>

    <nav>
        <ul>
            <div><a href="giris.html"><img src="https://i.hizliresim.com/oyQbo2.png" id="logo"/></a></div>
            <li><a href="giris.html">Anasayfa</a></li>
            <li><a href="#">Rezervasyon Yap</a></li>
            <li><a href="#">Nerelerdeyiz</a></li>
            <li><a href="iletisim.html">İletişim</a></li>
            <li style="float:right;"><div class="dropdown">
                <button class="dropbtn">Giriş Yap</button>
                </div>
            </li>
        </ul>
    </nav>

    <div id="formkapsamgiris">
    <img id="formkapsamimggiris" src="https://i.hizliresim.com/gb4jdQ.png"/>
    <h3 id="formkapsamhgiris">Kullanıcı Girişi</h3>
    <form method="POST" action="">
        <div><input class="formkapsaminput" type="text" name="mailField" placeholder="E-mail"></div>
        <div><input class="formkapsaminput" type="password" name="passField" placeholder="Şifre"></div>
        <div><input id="formkapsambuttongiris" type="submit" value="Giriş Yap"></div>
        <div><button id="formkapsambuttongiris"><a href = "kayit.html" style="text-decoration: none; color: white;">Kayıt Ol</a></button></div>
        <div><p><a style="text-decoration: none; color: white; text-align: center; font-size: 15px; position: absolute; left: 140px; bottom: 70px; " href="sifresifirlama.html">Şifremi Unuttum!</a></p></div>
    </form>
    </div>
    
    <footer>
        <p>Copyright © 2019 - 2020 epark.com | Tüm hakları saklıdır</p>
        <div id="app"><a href="#"><img src="https://i.hizliresim.com/0rVv8Y.png" style="width: 110px; height: 40px;"/></a></div>   
    </footer>


</body>

<?php closeConn(); ?>
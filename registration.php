<?php
	define('LOADED', TRUE);
	include 'htmlStart.php';
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
            <li><a href="#">İletişim</a></li>
            <li style="float:right;"><div class="dropdown">
                <button class="dropbtn">Giriş Yap</button>
                </div>
            </li>
        </ul>
    </nav>

    <div id="formkapsamkayit">
        <img id="formkapsamimgkayit" src="https://i.hizliresim.com/3gRYd4.png" />
        <h3 id="formkapsamhkayit">Kullanıcı Kayıt Formu</h3>
        <form method="POST" action="">
            <div><input class="formkapsaminput" type="text" name="userNameField" placeholder="Kullanıcı Adı"/></div>
            <div><input class="formkapsaminput" type="password" name="passField" placeholder="Şifre"/></div>
            <div><input class="formkapsaminput" type="text" name="mailField" placeholder="E-mail"/></div>
            <div><input class="formkapsaminput" type="text" name="fNameField" placeholder="İsim" /></div>
            <div><input class="formkapsaminput" type="text" name="lNameField" placeholder="Soyisim" /></div>
            <div><input class="formkapsaminput" type="tel" name="pNoField" placeholder="Telefon Numarası" /></div>
            <div><input id="formkapsambuttonkayit" type="submit" value="Üye Ol"></div>
            <div><button id="formkapsambuttonkayit"><a href = "giris.html" style="text-decoration: none; color: white;">Geri Dön</a></button></div>
        </form>
        </div>

        <footer>
            <p>Copyright © 2019 - 2020 epark.com | Tüm hakları saklıdır</p>
            <div id="app"><a href="#"><img src="https://i.hizliresim.com/0rVv8Y.png" style="width: 110px; height: 40px;"/></a></div>   
        </footer>

</body>

<?php closeConn(); ?>
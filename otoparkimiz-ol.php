<?php
    include_once('include/functions.php');
    includeExtContents("otoparkimiz-ol");
?>

<body id="otopark-body" onload="ckVersion();">

    <div id="form-otopark-sahibi">
        <h3 id="h3-baslik">Daha fazla müşteriye ulaşmak için EPS otoparkı olun!</h3>
        <h4 id="h4-otopark">Aşağıdaki formu doldurarak siz de EPS ailesine katılabilir, EPS müşterilerine hizmet vermeye
            hemen başlayabilirsiniz. Formu doldurduktan sonra ekibimiz sizinle iletişime geçerek işleminizi
            tamamlayacaktır.</h4>
        <div class="iletisim">

            <img src="/images/qr2.png" id="qr-code" alt="E-Park QR Code" />
            <div id="cizgi"></div>
            <div class="iletisimsag">
                <form method="POST" action="">
                    <div><input class="bilgi-girisi" type="text" name="OtoParkName" placeholder="Otopark Adı" />
                    </div>
                    <div><input class="bilgi-girisi" type="email" name="Mail" placeholder="E-mail" /></div>
                    <div><input class="bilgi-girisi" type="text" name="TelNo" placeholder="Telefon Numarası" pattern="[0-9]{3} [0-9]{3} [0-9]{2} [0-9]{2}"/>
                    </div>
                    <div><textarea class="otopark-adresi" placeholder="Otopark Adresi.."></textarea></div>
                    <div>
                        <p id="OtoParkFoto-yazi">Otoparkınızın Fotoğraflarını Yükleyiniz<input class="bilgi-girisi2"
                                type="file" name="OtoParkFoto" /></p>
                    </div>
                    <div><input id="buton2" type="submit" value="Gönder" onclick="parkForm(); return false;"></div>
                    <div><button id="buton2"><a href="" style="text-decoration: none; color: white;">Geri
                                Dön</a></button></div>
                </form>
            </div>
        </div>
    </div>

<?php include_once('include/bs-include/end.php'); ?>
<?php
    define('LOADED', TRUE);
    include_once('include/functions.php');
    includeExtContents("otoparkimiz-ol");
    getHeader();
?>

<body id="otopark-body" onload="ckVersion();">

<div class="otopark-hiza">
    <div id="form-otopark-sahibi">
        <h3 id="h3-baslik">EPS otoparkı olup daha fazla müşteriye ve daha fazla kazanca sahip olun!</h3>
        <h4 id="h4-otopark">Formu doldurarak anlaşmalı EPS otoparkı olmak için başvuru yapabilir ve hizmet vermeye
            başlayabilirsiniz. Başvurunuz değerlendirilip en kısa süre içerisinde size geri dönüş yapılacaktır.</h4>
        <div class="iletisim">

            <img src="/images/qr3.png" id="qr-code" alt="E-Park QR Code" />
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
</div>

<?php
    getFooter();
    include_once('include/bs-include/end.php');
?>
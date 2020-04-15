<?php
    define('LOADED', TRUE);
    include_once('include/functions.php');
    includeContents("registration");
    maintenanceMode(); //header olmadığından ek olarak eklendi.
    session_start();
?>

<div class="page-container"> <!--en dış div için yeni class eklendi-->
<div class="page-left"> <!-- sayfanın sol tarafındaki div için yeni class eklendi-->
    <form  class="form-registration" action="<?php echo getLink("registration"); ?>" method="POST" id="registrationForm"><!-- forma yeni class eklendi-->

        <!--<div id="formkapsamkayit">
            <img id="formkapsamimgkayit" src="https://i.hizliresim.com/3gRYd4.png" />
            <h3 id="formkapsamhkayit">Kullanıcı Kayıt Formu</h3>-->
                
                <div class="form-field"> <!--parça parça dive aldım yeni class eklendi-->
                <h1 class="form-title">Kayıt Ol</h1> <!--form-title class eklendi-->
                <p class="form-subtitle">Bilgileri eksiksiz doldurarak EPS'ye üye olabilirsiniz.</p><!--form-subtitle class eklendi-->
                </div>

                <div class="form-field"><!--div içindeki formInput class'ı form-field classı ile değişti -->
                    <h5 class="form-input-label">Kullanıcı Adı</h5> <!--yeni class eklendi-->
                    <input class="form-input" type="text" name="userName" placeholder="Kullanıcı Adı" /><!--input class formkapsaminput yerine form-input oldu-->
                </div>
                <div class="form-field"><!--div içindeki formInput class'ı form-field classı ile değişti -->
                    <h5 class="form-input-label">Şifre</h5> <!--yeni class eklendi-->
                    <input class="form-input" type="password" name="pass" placeholder="Şifre" /><!--input class formkapsaminput yerine form-input oldu-->
                </div>
                <div class="form-field"><!--div içindeki formInput class'ı form-field classı ile değişti -->
                    <h5 class="form-input-label">İsim</h5> <!--yeni class eklendi-->
                    <input class="form-input" type="text" name="fName" placeholder="İsim" /><!--input class formkapsaminput yerine form-input oldu-->
                </div>
                <div class="form-field"><!--div içindeki formInput class'ı form-field classı ile değişti -->
                    <h5 class="form-input-label">Soyisim</h5> <!--yeni class eklendi-->
                    <input class="form-input" type="text" name="lName" placeholder="Soyisim" /><!--input class formkapsaminput yerine form-input oldu-->
                </div>
                <div class="form-field"><!--div içindeki formInput class'ı form-field classı ile değişti -->
                    <h5 class="form-input-label">E-mail</h5> <!--yeni class eklendi-->
                    <input class="form-input" type="text" name="email" placeholder="E-mail" /><!--input class formkapsaminput yerine form-input oldu-->
                </div>
                <div class="form-field"><!--div içindeki formInput class'ı form-field classı ile değişti -->
                    <h5 class="form-input-label">Telefon Numarası</h5> <!--yeni class eklendi-->
                    <input class="form-input" type="tel" name="pNo" placeholder="Telefon Numarası 530-123-45-67" pattern="[0-9]{3} [0-9]{3} [0-9]{2} [0-9]{2}"/><!--input class formkapsaminput yerine form-input oldu-->
                </div>

                <div class="form-field"><!--div içindeki button-row class'ı form-field classı ile değişti -->
                    <input type="submit" value="Üye Ol" class="form-button" onclick="formValidation(); return false;"><!--input class submit-button yerine form-button oldu-->
                    <p class="form-info-text"><?php echo "<a href=\"".getLink("login")."\">Geri Dön</a>"; ?></p>
                    <!--class b-type-link kaldırıldı yerine p etiketine alınıp form-info-text class eklendi -->    
                </div>           
    </form>

</div>

    <!--ekranın sağ tarafındaki div içineresim eklendi ve bu resim için yeni class oluşturuldu-->
    <img class="form-image" src="https://images.wallpaperscraft.com/image/cars_parking_dividing_lines_122567_1080x1920.jpg">

</div>

<?php
    closeConn();
    print_js_or_css(jsSource());
?>

    </body>
</html
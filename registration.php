<?php
    define('LOADED', TRUE);
    include_once('include/functions.php');
    includeContents("registration");
    maintenanceMode();
    session_start();
?>

<div class="page-container">
<div class="page-left">
    <form  class="form-registration" action="<?php echo getLink("registration"); ?>" method="POST" id="registrationForm">

                <div class="form-field">
                <h1 class="form-title">Kayıt Ol</h1>
                <p class="form-subtitle">Bilgileri eksiksiz doldurarak EPS'ye üye olabilirsiniz.</p>
                </div>

                <div class="form-field">
                    <h5 class="form-input-label">Kullanıcı Adı</h5>
                    <input class="form-input" type="text" name="userName" placeholder="Kullanıcı Adı" />
                </div>
                <div class="form-field">
                    <h5 class="form-input-label">Şifre</h5>
                    <input class="form-input" type="password" name="pass" placeholder="Şifre" />
                </div>
                <div class="form-field">
                    <h5 class="form-input-label">İsim</h5>
                    <input class="form-input" type="text" name="fName" placeholder="İsim" />
                </div>
                <div class="form-field">
                    <h5 class="form-input-label">Soyisim</h5>
                    <input class="form-input" type="text" name="lName" placeholder="Soyisim" />
                </div>
                <div class="form-field">
                    <h5 class="form-input-label">E-mail</h5>
                    <input class="form-input" type="text" name="email" placeholder="E-mail" />
                </div>
                <div class="form-field">
                    <h5 class="form-input-label">Telefon Numarası</h5>
                    <input class="form-input" type="tel" name="pNo" placeholder="Telefon Numarası 530-123-45-67" pattern="[0-9]{3} [0-9]{3} [0-9]{2} [0-9]{2}"/>
                </div>
				<div>
				<input type="checkbox" id="kullanim-kosullari" name="kullanim-kosullari" checked="" disabled="" style="margin-top: 10px;">
				<label><a href="http://epark.sinemakulup.com/kullanim-kosullari" style="color: black; text-decoration: underline;">Kullanım Koşullarını</a> kabul ediyorum.</label><br>
				</div>
                <div class="form-field">
                    <input type="submit" value="Üye Ol" class="form-button" onclick="formValidation(); return false;">
                    <p class="form-info-text"><?php echo "<a href=\"".getLink("login")."\">Geri Dön</a>"; ?></p>
                </div>           
    </form>

</div>

    <img class="form-image" src="<?php echo isDevelopmentModeOn();?>images/img-registration1.jpg">

</div>

<?php
    closeConn();
    print_js_or_css(jsSource());
?>

    </body>
</html
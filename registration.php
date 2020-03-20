<?php
	define('LOADED', TRUE);
	include 'htmlStart.php';
	maintenanceMode(); //header olmadığından ek olarak eklendi.
	session_start();
?>


    <form action="<?php echo getLink("registration"); ?>" method="POST" id="registrationForm">
        <div id="formkapsamkayit">
            <img id="formkapsamimgkayit" src="https://i.hizliresim.com/3gRYd4.png" />
            <h3 id="formkapsamhkayit">Kullanıcı Kayıt Formu</h3>
                <div><input class="formkapsaminput" type="text" name="userName" placeholder="Kullanıcı Adı" /></div>
                <div><input class="formkapsaminput" type="password" name="pass" placeholder="Şifre" /></div>
                <div><input class="formkapsaminput" type="text" name="fName" placeholder="İsim" /></div>
                <div><input class="formkapsaminput" type="text" name="lName" placeholder="Soyisim" /></div>
                <div><input class="formkapsaminput" type="text" name="email" placeholder="E-mail" /></div>
                <div><input class="formkapsaminput" type="tel" name="pNo" placeholder="Telefon Numarası 530-123-45-67" pattern="[0-9]{3} [0-9]{3} [0-9]{2} [0-9]{2}"/></div>

                <div class="button-row">
                    <input type="submit" value="Üye Ol" class="submit-button" onclick="formValidation(); return false;">
                    <?php echo "<a href=\"".getLink("login")."\" class=\"b-type-link\">Geri Dön</a>"; ?>
                </div>
    	</div>
    </form>

<?php
	closeConn();
	print_js_or_css(jsSource());
?>

    </body>
</html
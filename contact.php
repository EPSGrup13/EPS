<?php
	define('LOADED', TRUE);
	include_once('include/functions.php');
	includeContents("contact");
	getHeader();
?>

   <div id="form-elemanlari">
        <center>
            <h2>Bize Ulaşın</h2>
        </center>
        <form class="needs-validation" novalidate>
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label for="validationTooltip01">Adnınız</label>
                    <input type="text" class="form-control" id="validationTooltip01" placeholder="Adınız" required>
                    <div class="valid-tooltip">
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationTooltip02">Soyadınız</label>
                    <input type="text" class="form-control" id="validationTooltip02" placeholder="Soyadınız" required>
                    <div class="valid-tooltip">
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="validationTooltipUsername">E-mail</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="validationTooltipUsernamePrepend">@</span>
                        </div>
                        <input type="text" class="form-control" id="validationTooltipUsername"
                            placeholder="E-Posta adresiniz" aria-describedby="validationTooltipUsernamePrepend"
                            required>
                        <div class="invalid-tooltip">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="validationTooltip03">Telefon Numarası</label>
                    <input type="text" class="form-control" id="validationTooltip03" placeholder="0-(555)-555-5555"
                        required>
                    <div class="invalid-tooltip">
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationTooltip04">Şehriniz</label>
                    <input type="text" class="form-control" id="validationTooltip04" placeholder="Bulunduğunuz Şehir"
                        required>
                    <div class="invalid-tooltip">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <center><label for="exampleFormControlTextarea1">Mesajınız</label></center>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Mesajınız..."
                    style=" max-height: 130px;
                max-width: 384px;
                margin: auto; min-height: 130px; resize: none"></textarea>
            </div>
            <center><button class="btn btn-primary" type="submit">Gönder</button></center><br>
        </form>
    </div>
    <div>
        <div>
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d6011.603485079791!2d29.000843917321603!3d41.11702075758409!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x31560b35ad4848d0!2sBeykent%20%C3%9Cniversitesi!5e0!3m2!1str!2str!4v1586915768366!5m2!1str!2str"
                width="100%" height="400px" frameborder="0" style="border:0" allowfullscreen=""></iframe>
        </div>
    </div>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

<?php
	getFooter();
	getHtmlEnd();
?>
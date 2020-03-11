<?php
	define('LOADED', TRUE);
	include 'htmlStart.php';
	getHeader();
?>

<div class="content">

	
    <div id="formkapsamiletisim">
        <h3 id="formkapsamhiletisim">Bize Ulaşın</h3>
        <div class="contact">
	        <div class="iletisimsoldiv"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3005.79004160427!2d29.00176061537765!3d41.11727627928995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14cab5b58ba7eeff%3A0x31560b35ad4848d0!2sBeykent%20%C3%9Cniversitesi!5e0!3m2!1str!2str!4v1582638797728!5m2!1str!2str" width="400" height="380" frameborder="0" style="border:0;" allowfullscreen=""></iframe></div>
	        <div id="verticle"></div>
        	<div class="iletisimsagdiv">
		        <form method="POST" action="">
		            <div><input class="formkapsaminput" type="text" name="userNameField" placeholder="Kullanıcı Adı"/></div>
		            <div><input class="formkapsaminput" type="text" name="mailField" placeholder="E-mail"/></div>
		            <div><input class="formkapsaminput" type="tel" name="pNoField" placeholder="Telefon Numarası" /></div>
		            <div><textarea class="formTextArea" placeholder="Mesajınızı buraya yazınız.."></textarea></div>
		            <div><input id="formkapsambuttoniletisim" type="submit" value="Gönder"></div>
		            <div><button id="formkapsambuttoniletisim"><a href = "<?php echo getLink("index"); ?>" style="text-decoration: none; color: white;">Geri Dön</a></button></div>
		        </form>
        	</div>
	    </div>
	</div>


</div>


<?php
	getFooter();
	getHtmlEnd();
?>
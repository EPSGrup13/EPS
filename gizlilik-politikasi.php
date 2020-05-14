<?php
    define('LOADED', TRUE);
    include_once('include/functions.php');
    includeExtContents("gizlilik-politikasi");
    getHeader();
?>

<body id="gizlilik">

    <div id="gizlilik-kutu">

        <p id="gizlilik-p"><strong><span
                    style="text-decoration: underline overline; font-size: 25px; padding-left: 40%; padding-right: 10%; ">
                    Gizlilik Politikası </span></strong><br>

            <i class="fas fa-paperclip"></i> EPS sistemi;<br>
            Kişisel bilgilerinizi (Ad, Soyad, Telefon No, E-posta, Plaka), işletim sistemi, konum bilgileri, otoparklar
            için yapılan yorumlarınızı, puanlamalarınızı, iletişim bölümünden yaptığınız her türlü öneri, bilgi edinme,
            istek, şikayet, teşekkür ve yaptığınız rezervasyon işlemlerinizi saklamaktadır.<br><br>
        </p>
    </div>
	
	<div id="gizlilik-kutu-2">
	<p id="gizlilik-p">

            <i class="fas fa-paperclip"></i> EPS topladığı bilgileri; <br>
            Kullanıcıların kimliğini doğrulama, güncellemeler veya hatalar hakkında bilgilendirmede, herhangi bir sorun
            olduğu şartlarda kullanıcı ile iletişim halinde bulunabilmek için kullanacaktır. Kullanıcı sisteme
            kaydettiği e-mail adresi ve telefon numarasına EPS tarafından gönderilecek bilgilendirme mesajları, reklam
            vb. mail ve mesajların gelmesini onaylamış kabul edilir. EPS, üyelerine mail veya sms gönderme yetkisine
            sahiptir. Kullanıcılar uygulamaya kayıt olup kullanmakla tüm bu şartları kabul etmiş sayılacaktır. EPS
            üyeleri kendilerine e-posta ya da mesaj atılmasını istemiyorsa sistem içerisinde bulunan geri bildirim
            bölümünden durumu bize bildirebilir.<br><br>
        </p>
    </div>
	
	<div id="gizlilik-kutu-3">
	<p id="gizlilik-p">
            <i class="fas fa-paperclip"></i> Bildirimler; <br>
            EPS sistem içindeki güncellemeler ve yeniliklerden sizleri haberdar etmek için size sistem içi bildirimler
            ve mailler gönderebilir. Kullanıcı bildirimleri uygulamayı kullandığı cihazdan veya internet sitesi
            üzerinden kapatabilme hakkına sahiptir.
            EPS gizlilik politikasını değiştirme hakkını her zaman saklı tutar. Herhangi bir değişiklik durumunda
            değişikliklere taraflara bildirilecektir. <br><br>
        </p>
    </div>

<?php
    getFooter();
    include_once('include/bs-include/end.php');
?>
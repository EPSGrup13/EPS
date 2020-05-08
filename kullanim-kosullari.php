<?php
    define('LOADED', TRUE);
    include_once('include/functions.php');
    includeContents("kullanim-kosullari");
    getHeader();
?>

<body id="kullanim" onload="ckVersion();">

    <div id="kullanim-kutu">

        <p id="kullanim-p"><strong>Başvuru ve Üyelik ;</strong><br>
            Kullanıcının uyması gereken birtakım yükümlülükler bulunmaktadır: <br><br>
            Başvuru ve Üyelik <br><br>
            1.1 Kullanıcı uygulamayı indirip, kayıt için gerekli bilgileri doldurup şifresini belirledikten sonra kayıt
            olarak sözleşmeyi kabul etmiş sayılır. Kabul ettiği sözleşme kurallarınca sistemi kullanmaya
            başlayabilir.<br>
            1.2 Müşteri kayıt anında verdiği tüm bilgileri daima düzgün ve gerçeğe uygun bir biçimde verdiğini kabul
            eder.<br>
            1.3 Müşteri rezervasyon ücretini ve otopark işlem tutarını uygulama içerisinden ödemeyi kabul eder.<br>
        </p>
    </div>

    <div id="kullanim-kutu-2">

        <p id="kullanim-p-2"><strong>Uygulama Kullanımı ;</strong><br><br>
            2.0.1 Kullanıcı sisteme kayıt olduktan sonra veya giriş yaptıktan sonra seçtiği otoparka rezervasyon yap
            butonuna tıkladığında, otoparka yer ayırma isteğinde bulunur. Otopark görevlisine kullanıcıya ait araç
            plakası ve geleceği vakit paylaşılır.<br>
            • 2.0.2 EPS, otoparka yapılan rezervasyonların onaylanacağı konusunda garanti vermez. Otopark yetkilisi
            rezervasyonu onaylamadığı taktirde, kullanıcıya rezervasyonun reddedildiği bildirilir.<br>
            • 2.0.3 Müşteri otopark rezervasyonu yaptığı halde otoparka gitmediği zaman rezervasyon işleminin uygunsuz
            biçimde kullanılmasını engellemek adına alınacak blokasyon ücreti iade edilmez.<br>
            • 2.0.4 Müşteri, rezervasyon ücretini ve otopark işlem ücretini sisteme önceden yüklemiş olduğu bakiyeden
            kullanarak öder.<br>
            • 2.0.5 Kullanıcının hesabında yeterli miktarda bakiye bulunmadığı tespit edilmediği taktirde rezervasyon
            işlemi gerçekleştirilmez.<br>
            • 2.0.6 Kullanıcının sisteme bakiye yükleme amacıyla kullanacağı kart bilgileri EPS sunucularında tutulmaz.<br>
            • 2.0.7 Müşteri şikayetçi olduğu otoparkları, uygulama içerisinde bulunan öneri ve şikayet bölümünden
            yetkili kişilere iletebilir anca EPS bundan sorumlu tutulamaz. Şikayet edilen otoparklar uyarılır ve ilgili
            konu devam ederse otopark ile EPS arasındaki anlaşma feshedilir.<br>
            • 2.0.8 Müşteri sistemi hukuka ve amacına uygun şekilde kullanmayı ve sistemde yaptığı her işlem ve
            eylemdeki hukuki sorumluluğun kendisine ait olduğunu kabul eder. Bu sebepten dolayı EPS doğrudan veya
            dolaylı olarak hiçbir şekilde sorumlu tutulamaz.<br>
            • 2.0.9 Kullanıcı, sistemi kullanabilmek için kullandığı kişisel bilgilerinin (Şifre, Telefon vb.)
            güvenliğini, saklanmasını ve üçüncü kişilerden korunması ile ilgili tüm sorumluluğun kendisine ait olduğunu
            kabul eder.<br>
            • 2.1.0 Kullanıcı EPS'nin ücretsiz olarak sunduğu hizmetleri istismar edebilecek herhangi bir işlem ve
            eylemde bulunmamayı kabul eder.<br>
            • 2.1.1 Kullanıcı belirtilen koşullara aykırı davrandığı taktirde EPS, üyeliği askıya alma veya üyelikten
            çıkarma hakkını saklı tutar.<br>
            • 2.1.2 Kullanıcı sistem içerisinde bulunan destek bölümünden herhangi bir sebep olmaksızın üyeliği iptal
            edebilir.<br>
        </p>
    </div>

<?php
    getFooter();
    include_once('include/bs-include/end.php');
?>
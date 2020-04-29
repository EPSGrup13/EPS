<?php
    include_once('include/functions.php');
    includeExtContents("sss");
?>

<body id="sss-body" onload="ckVersion();" style="background-color: #e8e8e8; ">

<div class="accordion-sss">
        <ul class="ul-sss">
            <li>
                <h4 class="sss-question" style="border-top-left-radius: 10px;">Biz ne yapıyoruz?</h4>
                <p class="sss-answer">EPS, otoparkların fiyatlarını, yerlerini göstererek otoparklara rezervasyon
                    yapılmasını sağlayan mobil uygulamadır. Arabanı park etmek için boşuna vakit harcamana gerek yok.
                    Uygulamaya girerek otoparkların nerede olduğunu görebilir, rezervasyon yaparak yerini ayırabilir ve ödemeni cep telefonundan
                    yaparak arabanı rahatça park edebilirsin.</p>
            </li>

            <li>
                <h4 class="sss-question">EPS ücretli mi?</h4>
                <p class="sss-answer">EPS'yi ücretsiz olarak cep telefonunuza indirebilirsiniz.</p>
            </li>

            <li>
                <h4 class="sss-question"> Hangi bölgede hizmet veriyoruz?</h4>
                <p class="sss-answer">Şu an için İstanbul içerisinde hizmet vermekteyiz. Diğer
                    iller için çalışmalarımız devam
                    etmektedir.</p>
            </li>

            <li>
                <h4 class="sss-question"> Çalışma saati nedir? </h4>
                <p class="sss-answer">EPS sizlere 7/24 hizmet sağlamaktadır. İstediğiniz
                    zaman müşteri hizmetlerimizden
                    yardım alabilirsiniz.</p>
            </li>

            <li>
                <h4 class="sss-question"> Otopark ücretini nasıl ödeyeceğim?</h4>
                <p class="sss-answer">Otoparka rezervasyon yaptığınız anda otopark tarifesinde
                    bulunan minimum ücret ve kaç
                    saat sonrasına rezervasyon yaptığınıza bağlı olarak rezervasyon ücreti alınır.
                    Otoparktan çıkış yapacağınızda içeride kaldığınız toplam süreye bağlı olarak +2 saat fazladan ödeme
                    gerçekleştirilir. 2 saat güvence bedeli, kullanıcı zamanında çıkış yaptığı taktirde bakiyesine geri
                    yansıtılmaktadır. </p>
            </li>

            <li>
                <h4 class="sss-question"> Otoparka nasıl rezervasyon yapabilirim?</h4>
                <p class="sss-answer">EPS uygulaması ile otoparka giriş yapmanızdan minimum
                    10 dakika öncesine kadar
                    rezervasyon yapabilirsiniz. Otoparkın rezervasyon ücreti ödemesi gerçekleştirilince
                    otoparktaki yeriniz ayrılmış olur.</p>
            </li>

            <li>
                <h4 class="sss-question">Nakit ödeme yapılabiliyor mu?</h4>
                <p class="sss-answer">EPS rezervasyon ücretini nakit ödeme ile kabul
                    edilmemektedir. Tüm ödemelerinizi
                    yüksek güvenlik önlemleri ile korunan online sistemimiz üzerinden
                    gerçekleştirebilirsiniz.</p>
            </li>

            <li>
                <h4 class="sss-question">Kartımın limiti yetersiz. Otopark ücretini nasıl
                    ödemeliyim?</h4>
                <p class="sss-answer">Otopark rezervasyonu yapabilmek için farklı kartla ödeme
                    yapabilirsiniz. En fazla 2 farklı banka kartı ile ödeme yapabilirsiniz.</p>
            </li>

            <li>
                <h4 class="sss-question"> Rezervasyon iptal işlemlerini nasıl
                    gerçekleştirebilirim?</h4>
                <p class="sss-answer">E-Park uygulamasında rezervasyon iptali sürecini
                    rezervasyon saatine 10 dakika kalıncaya kadar iptal edebilirler. Otoparka geç
                    kalma durumunda rezervasyon işleminiz hiçbir şekilde iptal edilmez.</p>
            </li>

            <li>
                <h4 class="sss-question"> Otopark fiyatları güncel midir?</h4>
                <p class="sss-answer">Otopark fiyatları doluluk oranına, otoparkın bulunduğu
                    sss-questionma ve günlere bağlı olarak değişiklik
                    gösterebilmektedir. Her kullanıcı
                    rezervasyon yaptığı tarifeden ücretlendirilmektedir.</p>
            </li>

            <li>
                <h4 class="sss-question"> Uygulamada problem olduğunda ne yapmalıyım?</h4>
                <p class="sss-answer">EPS uygulamasında herhangi bir problem ile
                    karşılaşırsınız uygulama içerisindeki
                    iletişim bölümünden bizlere rahatça ulaşabilirsiniz.</p>
            </li>

            <li>
                <h4 class="sss-question"> Kişisel bilgilerim güvende mi?</h4>
                <p class="sss-answer">En sıkı güvenlik önlemleri ile kişisel bilgilerinizi
                    korumaktayız. Kişisel bilgileriniz
                    hiçbir şekilde başka kurum, kuruluş veya birey ile paylaşılmamaktadır.</p>
            </li>

            <li>
                <h4 class="sss-question" style="border-bottom-right-radius: 10px;">Park etmek istediğiniz bölgede otopark yoksa ne
                    yapmalıyım?</h4>
                <p class="sss-answer">Öneri ve Şikâyetlerinizi İletişim bölümünden otopark adını
                    veya otopark ihtiyacınız bulunan bölgeyi
                    yazarak bize ulaşabilirsiniz. Kısa sürede ekibimiz sizin için istediğiniz noktadan
                    hizmet almanızı sağlayacaktır.</p>
            </li>
        </ul>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        $(function () {
            $(".sss-question").on("click", function () {
                $("ul li p").stop().slideUp();
                $(this).next("p").stop().slideToggle();
            })
        })

</script>

<?php include_once('include/bs-include/end.php'); ?>
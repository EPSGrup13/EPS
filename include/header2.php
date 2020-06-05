<body id="header2body">
    <div class="menu-genel">
        <div class="menuHeader">
            <div class="mobil_menu"><i class="fa fa-bars 2px" style="color: white;"></i></div>
            <ul>
                <li><a href="#">Anasayfa</a></li>
                <li><a href="#">Rezervasyon</a></li>
                <li><a href="#">Otoparkımız Ol</a></li>
                <li><a href="#">İletişim</a></li>
                <li class="li-giris"><a href="#">Giriş Yap</a></li>
            </ul>

        </div>

        <script>
            $(function () {
                $(".mobil_menu").click(function () {
                    $(this).next("ul").toggle(200);
                });
            });
        </script>

    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="CSS/CSSFile.css"/>

</body>
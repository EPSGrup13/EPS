/* Index sayfası yukarı buton */
$(document).ready(function () {
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.yukari-buton').fadeIn();
        } else {
            $('.yukari-buton').fadeOut();
        }
    });

    $('.yukari-buton').click(function () {
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });
});


/* Index target="_blank" yerine seo uyumlu */
function YeniSekme() {
    if (!document.getElementsByTagName) return;
    var linkler = document.getElementsByTagName("a");
    var linklerAdet = linkler.length;
    for (var i = 0; i < linklerAdet; i++) {
        var tekLink = linkler[i];
        if (tekLink.getAttribute("href") && tekLink.getAttribute("rel") == "external") {
            tekLink.target = "_blank";
        }
    }
}
window.onload = YeniSekme;


/* Index mobil menü 3 çizgi */
$(function () {
    $(".mobil-menu").click(function () {
        $(this).next("ul").toggle(200);
    });
});


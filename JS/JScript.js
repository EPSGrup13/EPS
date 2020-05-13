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

/* Index sayfası header scroll renk değişimi */
"use strict";

const htmlTag = document.querySelector('html');
const bodyTag = document.querySelector('body');
const myNav = document.querySelector('#menu_scroll');

let scrolled = () => {
    let sayfa = scrollY / (bodyTag.scrollHeight - innerHeight);
    return Math.floor(sayfa * 3000);
}

addEventListener('scroll', () => {
    myNav.style.setProperty('background', scrolled() > 50 ? "var(--color2)" : "var(--color1)");
})

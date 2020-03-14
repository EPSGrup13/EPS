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
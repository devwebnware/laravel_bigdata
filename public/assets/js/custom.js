// Landing-page partner

$(".partner-slider").owlCarousel({
    loop: true,
    margin: 40,
    nav: false,
    dots: false,
    autoplay: true,
    items: 6,
    autoplayHoverPause: true,
    responsiveClass: true,
    responsive: {
        0: {
            items: 3,
        },
        576: {
            items: 4,
        },
        991: {
            items: 5,
        },
        1200: {
            items: 6,
        },
    },
});

// landing-service-dev

$(".landing-service-dev").owlCarousel({
    loop: false,
    margin: 20,
    dots: false,
    nav: false,
    autoplay: false,
    items: 3,
    autoplayHoverPause: false,
    responsiveClass: true,
    responsive: {
        0: {
            items: 1,
            autoplay: true,
            loop: true,
        },
        768: {
            items: 2,
            autoplay: true,
            loop: true,
        },
        992: {
            items: 3,
            autoplay: false,
            loop: false,
        },
    },
});

// landing-service-dev-2

$(".landing-service-dev-2").owlCarousel({
    loop: true,
    margin: 20,
    dots: false,
    nav: false,
    autoplay: true,
    items: 5,
    autoplayHoverPause: true,
    responsiveClass: true,
    responsive: {
        0: {
            items: 1,
        },
        560: {
            items: 2,
        },
        768: {
            items: 3,
        },
        1400: {
            items: 4,
        },
    },
});

$(document).ready(function () {
    $(window).scroll(function () {
        if ($(document).scrollTop() >= 100) {
            $("header").addClass("header-stricky");
        } else {
            $("header").removeClass("header-stricky");
        }
    });
});
$(document).ready(function () {
    $('#popup-1').removeClass('active');
    $('.validform').removeClass('details');
    $('#submit-1').on('click', function () {
        $('.validform').addClass('details');
        $('#popup-1').addClass('active');
    })
    $('.btn').click(function () {
        $('#popup-1').removeClass('active');
        $('.validform').removeClass('details');
    })
});


$(document).ready(function () {
    $('#popup-2').removeClass('active');
    $('.validform').removeClass('detail');
    $('#submit-2').on('click', function () {
        $('.validform').addClass('detail');
        $('#popup-2').addClass('active');
    })
    $('.btn').click(function () {
        $('#popup-2').removeClass('active');
        $('.validform').removeClass('detail');
    })
})
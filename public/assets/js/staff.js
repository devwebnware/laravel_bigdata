/* Carousel */

$(document).ready(function () {
    $('.staff-partner').owlCarousel({
        items: 6,
        loop: true,
        margin: 10,
        nav: false,
        dots: false,
        autoplay: true,
        autoplayTimeout: 1000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 4
            },
            1000: {
                items: 6
            }
        }
    })

    $('.softwares-icons').owlCarousel({
        items: 6,
        loop: true,
        margin: 10,
        nav: false,
        dots: false,
        autoplay: true,
        autoplayTimeout: 1000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 4
            },
            1000: {
                items: 6
            }
        }
    })
});


/* Tab */

$(document).ready(function () {
    $('.list li').each(function () {
        $('#tab-1').css('display', 'block');
        $('#tab-2').css('display', 'none');
        $('#tab-3').css('display', 'none');
        $('#tab-4').css('display', 'none');
        $('#tab-5').css('display', 'none');
        $('#tab-6').css('display', 'none');
        $('#develop a').css('background', '#fba945');
        $('#develop a').css('border-radius', '50px');

        $('#develop a').click(function () {
            $('#develop a').css('background', '#fba945');
            $('#develop a').css('border-radius', '50px');
            $('#Designers a').css('background', 'transparent');
            $('#Experts a').css('background', 'transparent');
            $('#Project a').css('background', 'transparent');
            $('#Product a').css('background', 'transparent');
            $('#Sales a').css('background', 'transparent');
            $('#tab-1').css('display', 'block');
            $('#tab-2').css('display', 'none');
            $('#tab-3').css('display', 'none');
            $('#tab-4').css('display', 'none');
            $('#tab-5').css('display', 'none');
            $('#tab-6').css('display', 'none');
        })
        $('#Designers a').click(function () {
            $('#Designers a').css('background', '#fba945');
            $('#Designers a').css('border-radius', '50px');
            $('#develop a').css('background', 'transparent');
            $('#Experts a').css('background', 'transparent');
            $('#Project a').css('background', 'transparent');
            $('#Product a').css('background', 'transparent');
            $('#Sales a').css('background', 'transparent');
            $('#tab-1').css('display', 'none');
            $('#tab-2').css('display', 'block');
            $('#tab-3').css('display', 'none');
            $('#tab-4').css('display', 'none');
            $('#tab-5').css('display', 'none');
            $('#tab-6').css('display', 'none');
        })
        $('#Experts a').click(function () {
            $('#Experts a').css('background', '#fba945');
            $('#Experts a').css('border-radius', '50px');
            $('#develop a').css('background', 'transparent');
            $('#Designers a').css('background', 'transparent');
            $('#Project a').css('background', 'transparent');
            $('#Product a').css('background', 'transparent');
            $('#Sales a').css('background', 'transparent');
            $('#tab-1').css('display', 'none');
            $('#tab-2').css('display', 'none');
            $('#tab-3').css('display', 'block');
            $('#tab-4').css('display', 'none');
            $('#tab-5').css('display', 'none');
            $('#tab-6').css('display', 'none');
        })
        $('#Project a').click(function () {
            $('#Project a').css('background', '#fba945');
            $('#Project a').css('border-radius', '50px');
            $('#develop a').css('background', 'transparent');
            $('#Designers a').css('background', 'transparent');
            $('#Experts a').css('background', 'transparent');
            $('#Product a').css('background', 'transparent');
            $('#Sales a').css('background', 'transparent');
            $('#tab-1').css('display', 'none');
            $('#tab-2').css('display', 'none');
            $('#tab-3').css('display', 'none');
            $('#tab-4').css('display', 'block');
            $('#tab-5').css('display', 'none');
            $('#tab-6').css('display', 'none');
        })
        $('#Product a').click(function () {
            $('#Product a').css('background', '#fba945');
            $('#Product a').css('border-radius', '50px');
            $('#develop a').css('background', 'transparent');
            $('#Designers a').css('background', 'transparent');
            $('#Project a').css('background', 'transparent');
            $('#Experts a').css('background', 'transparent');
            $('#Sales a').css('background', 'transparent');
            $('#tab-1').css('display', 'none');
            $('#tab-2').css('display', 'none');
            $('#tab-3').css('display', 'none');
            $('#tab-4').css('display', 'none');
            $('#tab-5').css('display', 'block');
            $('#tab-6').css('display', 'none');
        })
        $('#Sales a').click(function () {
            $('#Sales a').css('background', '#fba945');
            $('#Sales a').css('border-radius', '50px');
            $('#develop a').css('background', 'transparent');
            $('#Designers a').css('background', 'transparent');
            $('#Project a').css('background', 'transparent');
            $('#Experts a').css('background', 'transparent');
            $('#Product a').css('background', 'transparent');
            $('#tab-1').css('display', 'none');
            $('#tab-2').css('display', 'none');
            $('#tab-3').css('display', 'none');
            $('#tab-4').css('display', 'none');
            $('#tab-5').css('display', 'none');
            $('#tab-6').css('display', 'block');
        })
    })
});

$(document).ready(function () {
    $('#build-sec').css('display', 'block');
    $('#build a').css('color', '#161929');
    $('#build a').css('border-bottom', '6px solid #faa945');
    $('#build').click(function () {
        $('#build a').css('color', '#161929');
        $('#build a').css('border-bottom', '6px solid #faa945');
        $('#dream a').css('border-bottom', 'none');
        $('#dream a').css('color', '#c9c9c9');
        $('#build-sec').css('display', 'block');
        $('#dream-sec').css('display', 'none');
    })

    $('#dream').click(function () {
        $('#dream a').css('color', '#161929');
        $('#dream a').css('border-bottom', '6px solid #faa945');
        $('#build a').css('border-bottom', 'none');
        $('#build a').css('color', '#c9c9c9');
        $('#build-sec').css('display', 'none');
        $('#dream-sec').css('display', 'block');
    })
});
/* Progress Bar */


const scrollProgress = document.getElementById('scroll-progress');
const height =
    document.documentElement.scrollHeight - document.documentElement.clientHeight;

window.addEventListener('scroll', () => {
    const scrollTop =
        document.body.scrollTop || document.documentElement.scrollTop;
    scrollProgress.style.width = `${(scrollTop / height) * 150}%`;
});

var $ = jQuery.bind({});

document.addEventListener('click', function handleClick(event) {
    if (event.target) {
        if (event.target.classList.value == 'tab-option') {
            var divs = document.querySelectorAll('.tab-option');
            for (i = 0; i < divs.length; ++i) {
                divs[i].classList.remove('active');
            }
            var sections = document.querySelectorAll('.tab-sections');
            for (i = 0; i < sections.length; ++i) {
                sections[i].classList.remove('active');
            }
        }
        event.target.classList.add('active');
        var tabId = event.target.getAttribute('data-id');
        var element = document.getElementById(tabId);
        element.classList.add("active");

    }
});


$(document).ready(function () {
    $('a[href^="#"]').on('click', function (e) {
        e.preventDefault();
        var target = this.hash;
        var $target = $(target);
        $('html, body').stop().animate({
            'scrollTop': $target.offset().top - 110
        }, 900, 'swing', function () {
            // window.location.hash = target;
        });
    });
});
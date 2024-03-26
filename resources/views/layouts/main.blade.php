<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-3ZW42N09KM"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-3ZW42N09KM');
    </script>
    <!-- meta tags -->
    @yield('head')
    <link rel="shortcut icon" href="{{asset('assets/img/gl-favicon.png')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="{{asset('assets/css/font-poppins.css')}}">
    <!-- Fonts -->
    <link rel="stylesheet" href="{{asset('assets/css/fonts.min.css')}}">
    <!-- Default CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/style.min.css')}}">

    @stack('page-css')
    <!-- GL Icons -->
    <link rel="stylesheet" href="{{asset('assets/gl-icons/glicon.min.css')}}">
    <!--Popup-btn CSS-->
    <!-- Datepicker Modal Box CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/appointmentmodal.min.css')}}">
    <!-- Owl Caraousel CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/animations.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/header.css')}}" />
    <!-- Google tag (gtag.js) -->
    <meta name="yandex-verification" content="4547f6e884380fbe" />
</head>

<body>
    <script>
        window._mfq = window._mfq || [];
        (function() {
            var mf = document.createElement("script");
            mf.type = "text/javascript";
            mf.defer = true;
            mf.src = "//cdn.mouseflow.com/projects/9b1b2435-26f4-4c6a-8e13-ba2fbb6cdaad.js";
            document.getElementsByTagName("head")[0].appendChild(mf);
        })();
    </script>
    @include('layouts.partials.header')
    @yield('content')
    @include('layouts.partials.footer')
    <!-- Bootstrap JS and others -->
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
    @stack('page-scripts')
    <script src="{{asset('assets/js/css3-animate-it.min.js')}}"></script>
    <!--Script for Sticky Nav-->
    <script src="{{asset('assets/js/sticky.js')}}"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        $(document).ready(function() {
            $('.counter').each(function() {
                $(this).prop('Counter', 0).animate({
                    Counter: $(this).text()
                }, {
                    duration: 4000,
                    easing: 'swing',
                    step: function(now) {
                        $(this).text(Math.ceil(now));
                    }
                });
            });

        });
    </script>
    @stack('custom-js')
</body>
<script>
    $('#newsletter-form').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: "{{route('subscriber')}}",
            method: 'POST',
            data: $('#newsletter-form').serialize(),
            success: function(response) {
                if (response.success) {
                    $('#subscriber-email').val('');
                    $('#subscriberThanksModal').modal('show');
                } else {

                }
            }
        });
        $('#closesubscriberThanksModal').click(function() {
            $('#subscriberThanksModal').modal('hide');
        })
    });
</script>

</html>
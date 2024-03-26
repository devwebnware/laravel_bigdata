<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
        content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{ asset('assets/img/ad-favicon.png') }}">
    <!-- Page Title  -->
    <title>Admin Dashboard Dashboard</title>
    <!-- StyleSheets  -->
    @stack('page-css')
    <link rel="stylesheet" href="{{ asset('assets/css/dashlite.css?ver=2.4.0') }}">

    <!-- Font Awesome -->
    <link href="{{ asset('assets/font-awesome/css/all.css') }}" rel="stylesheet">
    <!-- Line Awesome -->
    <link href="{{ asset('icons/css/line-awesome.min.css') }}" rel="stylesheet">
    <!-- ad Icons -->

    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">

    <link id="skin-default" rel="stylesheet" href="{{ asset('assets/css/theme.css?ver=2.4.0') }}">
</head>

<body
    class="nk-body bg-lighter npc-general has-sidebar @if (auth()->user()->config) {{ auth()->user()->config['dark_mode'] == '1' ? 'dark-mode' : '' }} @endif">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">

            <!-- <sidebar> -->
            @include('backend.layouts.partials.sidebar')
            <!-- </sidebar> -->

            <!-- wrap @s -->
            <div class="nk-wrap ">

                <!-- <header> -->
                @include('backend.layouts.partials.header')
                <!-- </header> -->

                <!-- <content> -->
                <div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="nk-block nk-block-lg">
                                            <div class="alert-div" id="alert"></div>
                                            @yield('content')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- </content> -->

                <!-- <footer> -->
                @include('backend.layouts.partials.footer')
                <!-- </footer> -->
            </div>
            <!-- wrap @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <!-- JavaScript -->
    <script src="{{ asset('assets/js/bundle.js?ver=2.4.0') }}"></script>
    <script src="{{ asset('assets/js/scripts.js?ver=2.4.0') }}"></script>
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    @stack('page-scripts')
    @stack('custom-js')
    <script>
        $(document).ready(function() {
            $('.ri-select').select2({
                allowClear: true
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            var interval = setInterval(function() {
                var momentNow = moment();
                $('#date-part').html(momentNow.format('DD MMMM YYYY'));
                $('#time-part').html(momentNow.format('hh:mm:ss A'));
            }, 100);
        });
    </script>
    <script>
        $('.dark-switch').click(function() {
            let status = 1;
            if ($(".dark-switch").hasClass("active")) {
                status = 0;
            } else {
                status = 1;
            }
            $.ajax({
                type: "POST",
                url: "{{ route('user.configUpdate') }}",
                data: {
                    '_token': '{{ csrf_token() }}',
                    'status': status,
                    'key': 'dark_mode',
                },
                success: function(data) {}
            });
        });
    </script>
    @hasrole('admin')
    @else
        <script>
            $(document).bind("contextmenu", function(e) {
                e.preventDefault();
            });
            document.onkeydown = function(e) {
                if (event.keyCode == 123) {
                    return false;
                }
                if (e.ctrlKey && e.shiftKey && (e.keyCode == 'I'.charCodeAt(0) || e.keyCode == 'i'.charCodeAt(0))) {
                    return false;
                }
                if (e.ctrlKey && (e.keyCode == 'U'.charCodeAt(0) || e.keyCode == 'u'.charCodeAt(0))) {
                    return false;
                }
                if (e.ctrlKey && (e.keyCode == 'S'.charCodeAt(0) || e.keyCode == 's'.charCodeAt(0))) {
                    return false;
                }
            }
        </script>
    @endhasrole
    <script>
        $(document).on('select2:open', () => {
            document.querySelector('.select2-container--open .select2-search__field').focus();
        });
    </script>
    <script>
        $(document).ready(function() {
            $(document).ajaxStart(function() {
                $('<div class="text-center float-right loader"></div>')
                    .prependTo('body');
                $(".loader").addClass("loading");
            });
            $(document).ajaxComplete(function() {
                $(".loader").removeClass("loading");
                $(".loader").remove();
            });
        });
    </script>
</body>

</html>

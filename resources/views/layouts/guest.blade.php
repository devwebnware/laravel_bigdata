<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Dashboard</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body>
    <style>
        @media only screen and (max-width:767px) {
            .gl-logo-image {
                width: 70%;
                margin: 0 auto 0px;
            }
        }
    </style>
    <div class="font-sans text-gray-900 antialiased" style="display: flex;align-items: center; height: 95vh; background-color: #f3f4f6;justify-content: center;">
        {{ $slot }}
    </div>
</body>

</html>
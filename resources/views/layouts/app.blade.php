<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <meta name="author" content="Oxas Tech">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('logo.png')}}">

    @yield('header')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com"> --}}
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500&display=swap" rel="stylesheet">
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}

    <!-- Styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('vendor/@fortawesome/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/owlcarousel/assets/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/owlcarousel/assets/owl.theme.default.min.css')}}">
    <script src="{{asset('vendor/jquery/jquery.js')}}"></script>
    <script src="{{asset('vendor/owlcarousel/owl.carousel.min.js')}}"></script>
    @yield('captcha')
</head>
<body class="bg-white">
    <input type="hidden" id="sesion" value="0">
    <span hidden id="rootURL">{{ env('APP_URL') }}</span>

    <div id="app">

        @include('common.navbar')

        <main style="min-height:100vh;">
            @yield('content')
        </main>
    </div>

    {{-- Carrito de compras --}}
    @include('common.shopping_car')

    <!-- FOOTER -->
    @include('common.footer')

    <!-- ChatOnline -->
    {{-- @include('common.chat_online') --}}


    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</body>
</html>

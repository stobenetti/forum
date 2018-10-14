<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @laravelPWA

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
{{--<script src="{{ asset('js/app.js') }}" defer></script>--}}

<!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    {{--<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">--}}
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">

    <!-- Styles -->
    {{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    <link href="{{ asset('assets/vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/nucleo/css/nucleo.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/argon.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    @if (Auth::check())
        @include('layouts.navbar_logged_in')
    @else
        @include('layouts.navbar')
    @endif

    <main class="py-4">
        @yield('content')
    </main>
</div>


<!-- Core -->
<script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}" defer></script>
<script src="{{ asset('assets/vendor/popper/popper.min.js') }}" defer></script>
<script src="{{ asset('assets/vendor/bootstrap/bootstrap.min.js') }}" defer></script>
<script src="{{ asset('assets/js/argon.js') }}" defer></script>
</body>
</html>

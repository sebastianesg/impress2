<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE-edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, shrink-to-fit=no">
        
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Faivcon -->
        <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('front/images/apple-icon-57x57.png') }}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('front/images/apple-icon-60x60.png') }}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('front/images/apple-icon-72x72.png') }}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('front/images/apple-icon-76x76.png') }}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('front/images/apple-icon-114x114.png') }}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('front/images/apple-icon-120x120.png') }}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('front/images/apple-icon-144x144.png') }}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('front/images/apple-icon-152x152.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('front/images/apple-icon-180x180.png') }}">
        <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('front/images/android-icon-192x192.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('front/images/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('front/images/favicon-96x96.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('front/images/favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('front/images/manifest.json') }}">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="{{ asset('front/images/ms-icon-144x144.png') }}">
        <meta name="theme-color" content="#ffffff">
        
        <!-- Metas SEO -->
        <title>{{ __('login.title') }} - @yield('title')</title>
        <meta name="description" content="@yield('description')"/>
        <meta name="robots" content="index,follow"/>
        <meta name="GOOGLEBOT" content="index,follow"/>
        <meta name="category" content=""/>
        <meta name="author" content="Coding & Company"/>
        <meta name="keywords" content="@yield('keywords')"/>
        <link rel="canonical" href=""/>
        <link rel="dns-prefetch" href="">
        
        <!-- Lang -->
        <link rel="alternate" href="" hreflang="es-ar" />

        <!-- Vendors -->
        <link href="{{ asset('front/vendors/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('front/vendors/css/aos.min.css') }}" rel="stylesheet">
        <link href="{{ asset('front/vendors/css/animate.min.css') }}" rel="stylesheet">
        <link href="{{ asset('front/vendors/css/all.css') }}" rel="stylesheet">

        @yield('styles')
        
        <!-- Styles -->
        <link href="{{ asset('front/assets/css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <!-- Header -->
        @include('front.components.header')
        <!-- Content -->
        <main id="{{ $pageId }}">
            @yield('content')
        </main>
        <!-- Footer -->
        @include('front.components.footer')

        <!-- Vendors -->
        <script src="{{ asset('front/vendors/js/jquery.min.js') }}" defer></script>
        <script src="{{ asset('front/vendors/js/bootstrap.bundle.min.js') }}" defer></script>
        <script src="{{ asset('front/vendors/js/aos.min.js') }}" defer></script>

        <!-- Scripts -->
        <script src="{{ asset('front/assets/js/app.js') }}" defer></script>
        @yield('scripts')
        
    </body>
</html>

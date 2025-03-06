<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>@yield('judul')</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    @include('bagian.user.include.css')
    @stack('css')

    <!-- =======================================================
  * Template Name: Logis
  * Template URL: https://bootstrapmade.com/logis-bootstrap-logistics-website-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

    @include('bagian.user.include.header')

    <main class="main">

        @yield('isi')

    </main>

    {{-- @include('bagian.user.include.footer') --}}

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    @stack('js')
    @include('bagian.user.include.js')

</body>

</html>

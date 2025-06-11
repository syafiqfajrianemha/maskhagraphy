<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="{{ asset('images/favicon.png') }}" rel="icon">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
        rel="stylesheet">

    <link href="{{ asset('guest/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('guest/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('guest/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('guest/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('guest/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('guest/css/main.css') }}" rel="stylesheet">

    @stack('style')
</head>

<body class="index-page">

    @include('layouts.navigation-guest')

    <main class="main">
        {{ $slot }}
    </main>

    @include('layouts.footer-guest')

    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <div id="preloader"></div>

    <script src="{{ asset('guest/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('guest/aos/aos.js') }}"></script>
    <script src="{{ asset('guest/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('guest/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('guest/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('guest/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('guest/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('guest/js/main.js') }}"></script>

    @stack('script')
</body>

</html>

{{-- <!DOCTYPE html>
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

</html> --}}

<!DOCTYPE html>
<html lang="en">
<head>
  <title>{{ config('app.name', 'Laravel') }}</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="{{ asset('images/favicon.png') }}" rel="icon">

  <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;700&family=Roboto+Mono:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('new/fonts/icomoon/style.css') }}">

  <link rel="stylesheet" href="{{ asset('new/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('new/css/magnific-popup.css') }}">
  <link rel="stylesheet" href="{{ asset('new/css/jquery-ui.css') }}">
  <link rel="stylesheet" href="{{ asset('new/css/owl.carousel.min.css') }}">
  <link rel="stylesheet" href="{{ asset('new/css/owl.theme.default.min.css') }}">

  <link rel="stylesheet" href="{{ asset('new/css/lightgallery.min.css') }}">

  <link rel="stylesheet" href="{{ asset('new/css/bootstrap-datepicker.css') }}">

  <link rel="stylesheet" href="{{ asset('new/fonts/flaticon/font/flaticon.css') }}">

  <link rel="stylesheet" href="{{ asset('new/css/swiper.css') }}">

  <link rel="stylesheet" href="{{ asset('new/css/aos.css') }}">

  <link rel="stylesheet" href="{{ asset('new/css/style.css') }}">

</head>
<body>

  <div class="site-wrap">

    <div class="site-mobile-menu">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>




    <header class="site-navbar py-3" role="banner">

      <div class="container-fluid">
        <div class="row align-items-center">

          <div class="col-6 col-xl-2" data-aos="fade-down">
            <h1 class="mb-0"><a href="{{ route('home.index') }}" class="text-white h2 mb-0">Maskhagraphy</a></h1>
          </div>
          <div class="col-10 col-md-8 d-none d-xl-block" data-aos="fade-down">
            <nav class="site-navigation position-relative text-right text-lg-center" role="navigation">

              <ul class="site-menu js-clone-nav mx-auto d-none d-lg-block">
                <li class="{{ request()->routeIs('home.index') ? 'active' : '' }}"><a href="{{ route('home.index') }}">Home</a></li>
                <li class="{{ request()->routeIs('booking.index') ? 'active' : '' }}"><a href="{{ route('booking.index') }}">Booking</a></li>
                <li class="has-children{{ request()->is('more-photos/*') ? ' active' : '' }}">
                    <a href="#">Gallery</a>
                    <ul class="dropdown">
                        <li class="{{ request()->is('more-photos/all') ? 'active' : '' }}"><a href="/more-photos/all">All</a></li>
                        <li class="{{ request()->is('more-photos/potrait') ? 'active' : '' }}"><a href="/more-photos/potrait">Portrait</a></li>
                        <li class="{{ request()->is('more-photos/engagement') ? 'active' : '' }}"><a href="/more-photos/engagement">Engagement</a></li>
                        <li class="{{ request()->is('more-photos/prewedding') ? 'active' : '' }}"><a href="/more-photos/prewedding">Prewedding</a></li>
                        <li class="{{ request()->is('more-photos/wedding') ? 'active' : '' }}"><a href="/more-photos/wedding">Wedding</a></li>
                        <li class="{{ request()->is('more-photos/product') ? 'active' : '' }}"><a href="/more-photos/product">Product</a></li>
                        <li class="{{ request()->is('more-photos/family') ? 'active' : '' }}"><a href="/more-photos/family">Family</a></li>
                        <li class="{{ request()->is('more-photos/sport') ? 'active' : '' }}"><a href="/more-photos/sport">Sport</a></li>
                        <li class="{{ request()->is('more-photos/event') ? 'active' : '' }}"><a href="/more-photos/event">Event</a></li>
                        <li class="{{ request()->is('more-photos/birthday') ? 'active' : '' }}"><a href="/more-photos/birthday">Birthday</a></li>
                    </ul>
                </li>
                <li class="{{ request()->routeIs('about') ? 'active' : '' }}"><a href="{{ route('about') }}">About</a></li>
                @if (Route::has('login'))
                    @auth
                        <li class="has-children">
                            <a href="">{{ Auth::user()->name }}</a>
                            <ul class="dropdown">
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-danger py-2 px-4" style="border: none; background: transparent; cursor: pointer;">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li><a href="{{ route('login') }}">Login</a></li>
                    @endauth
                @endif
              </ul>
            </nav>
          </div>

          <div class="col-6 col-xl-2 text-right" data-aos="fade-down">
            <div class="d-none d-xl-inline-block">
              <ul class="site-menu js-clone-nav ml-auto list-unstyled d-flex text-right mb-0" data-class="social">
                <li>
                  <a href="https://www.instagram.com/maskhagraphy_" class="pl-3 pr-3"><span class="icon-instagram"></span></a>
                </li>
              </ul>
            </div>

            <div class="d-inline-block d-xl-none ml-md-0 mr-auto py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle text-black"><span class="icon-menu h3"></span></a></div>

          </div>

        </div>
      </div>

    </header>

    {{ $slot }}

    <div class="footer py-4">
      <div class="container-fluid text-center">
        <p>
          Copyright &copy;<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script>document.write(new Date().getFullYear());</script> All rights reserved | Maskhagraphy
        </p>
      </div>
    </div>





  </div>

  <script src="{{ asset('new/js/jquery-3.3.1.min.js') }}"></script>
  <script src="{{ asset('new/js/jquery-migrate-3.0.1.min.js') }}"></script>
  <script src="{{ asset('new/js/jquery-ui.js') }}"></script>
  <script src="{{ asset('new/js/popper.min.js') }}"></script>
  <script src="{{ asset('new/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('new/js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('new/js/jquery.stellar.min.js') }}"></script>
  <script src="{{ asset('new/js/jquery.countdown.min.js') }}"></script>
  <script src="{{ asset('new/js/jquery.magnific-popup.min.js') }}"></script>
  <script src="{{ asset('new/js/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('new/js/swiper.min.js') }}"></script>
  <script src="{{ asset('new/js/aos.js') }}"></script>

  <script src="{{ asset('new/js/picturefill.min.js') }}"></script>
  <script src="{{ asset('new/js/lightgallery-all.min.js') }}"></script>
  <script src="{{ asset('new/js/jquery.mousewheel.min.js') }}"></script>

  <script src="{{ asset('new/js/main.js') }}"></script>

  <script>
    $(document).ready(function(){
      $('#lightgallery').lightGallery();
    });
  </script>

</body>
</html>

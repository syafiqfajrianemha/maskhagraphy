<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
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
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card shadow" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="{{ asset('images/login.jpeg') }}"
                                    alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your
                                            account</h5>

                                        <div data-mdb-input-init class="form-outline mb-4 text-dark">
                                            <label class="form-label" for="form2Example17">Email Address</label>
                                            <input type="email" id="form2Example17" name="email"
                                                class="form-control form-control-lg" style="color: #000 !important" />
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <label class="form-label" for="form2Example27">Password</label>
                                            <input type="password" id="form2Example27" name="password"
                                                class="form-control form-control-lg" style="color: #000 !important" />
                                        </div>

                                        <div class="pt-1 mb-4">
                                            <button data-mdb-button-init data-mdb-ripple-init
                                                class="btn btn-dark btn-lg btn-block" type="submit">Login</button>
                                        </div>

                                        <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a
                                                href="{{ route('register') }}" style="color: #393f81;">Register here</a></p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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

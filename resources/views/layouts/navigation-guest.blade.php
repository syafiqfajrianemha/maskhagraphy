<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">
        <a href="{{ route('home.index') }}" class="logo d-flex align-items-center me-auto">
            <h1 class="sitename">maskhagraphy</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="{{ route('home.index') }}"
                        class="{{ request()->routeIs('home.index') ? 'active' : '' }}">Home</a></li>
                <li><a href="{{ route('booking.index') }}"
                        class="{{ request()->routeIs('booking.index') ? 'active' : '' }}">Booking</a></li>
                <li><a href="{{ route('portofolio.guest') }}"
                        class="{{ request()->routeIs('portofolio.guest') ? 'active' : '' }}">Portofolio</a></li>
                {{-- @if (Route::has('login'))
                    @auth
                        <li><a href="{{ route('collections.index') }}"
                            class="{{ request()->routeIs('collections.index') ? 'active' : '' }}">Collection</a></li>
                    @endauth
                @endif --}}
                {{-- <li>
                    <a href="{{ route('cart.index') }}">
                        <i class="bi bi-cart" style="font-size: 16px; font-style: normal;">
                            <span>{{ $cartCount }}</span>
                        </i>
                    </a>
                </li> --}}
                @if (Route::has('login'))
                    @auth
                        <li class="dropdown"><a href=""><span>{{ Auth::user()->name }}</span> <i
                                    class="bi bi-chevron-down toggle-dropdown"></i></a>
                            <ul>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-danger ps-4" style="border: none; background: transparent;">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endauth
                @endif
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
        @if (Route::has('login'))
            @auth

            @else
                <a class="btn-getstarted" href="{{ route('login') }}">Login</a>
            @endauth
        @endif
    </div>
</header>

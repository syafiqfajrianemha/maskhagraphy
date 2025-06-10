<x-guest-layout>
    <div id="carouselExampleCaptions" class="carousel slide vh-80" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('images/slider2.jpg') }}" class="d-block w-100" alt="..."
                    style="object-fit: cover; height: 80vh;">
                <div class="carousel-caption d-none d-md-block">
                    <h5>maskhagraphy</h5>
                    <p>Wedding, Prewedding, Foto Outdoor atau Hunting</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/slider1.jpg') }}" class="d-block w-100" alt="..."
                    style="object-fit: cover; height: 80vh;">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/slider3.jpg') }}" class="d-block w-100" alt="..."
                    style="object-fit: cover; height: 80vh;">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <section id="services" class="services section light-background">
        <div class="container section-title" data-aos="fade-up">
            <h2>maskhagraphy</h2>
            <p>Temukan fotografer terbaik untuk setiap kebutuhan Anda</p>
        </div>
        <div class="container">
            <div class="row gy-4 justify-content-center">
                <div class="col-lg-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-item position-relative">
                        <div class="icon">
                            <i class="bi bi-camera2"></i>
                        </div>
                        <a href="" class="stretched-link">
                            <h3>Layanan Fotografi Lengkap</h3>
                        </a>
                        <p>Dapatkan fotografer pilihan Anda untuk setiap kesempatan</p>
                    </div>
                </div>
                <div class="col-lg-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-item position-relative">
                        <div class="icon">
                            <i class="bi bi-cash-coin"></i>
                        </div>
                        <a href="" class="stretched-link">
                            <h3>Fotografer Profesional</h3>
                        </a>
                        <p>Fotografer Profesional Pilihan Anda untuk Setiap Momen Spesial</p>
                    </div>
                </div>
                <div class="col-lg-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-item position-relative">
                        <div class="icon">
                            <i class="bi bi-pen"></i>
                        </div>
                        <a href="" class="stretched-link">
                            <h3>Pengeditan Tanpa Batas</h3>
                        </a>
                        <p>Pengeditan yang mengagumkan untuk foto terbaik</p>
                    </div>
                </div>
                <div class="col-lg-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-item position-relative">
                        <div class="icon">
                            <i class="bi bi-wallet2"></i>
                        </div>
                        <a href="" class="stretched-link">
                            <h3>Pembayaran Aman</h3>
                        </a>
                        <p>Pembayaran kepada fotografer hanya setelah foto dikirimkan</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="call-to-action" class="call-to-action section accent-background py-5">
        <div class="container">
            <div class="row justify-content-center mb-4" data-aos="zoom-in" data-aos-delay="100">
                <div class="col-xl-10 text-center">
                    <h3>Hanya Empat Langkah untuk Mendapatkan Foto Terbaik</h3>
                </div>
            </div>
            <div class="row text-center justify-content-center">
                <div class="col-6 col-md-3 mb-4">
                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto text-dark"
                        style="width: 100px; height: 100px; font-size: 2rem;">
                        1
                    </div>
                    <p class="mt-2">Booking</p>
                </div>
                <div class="col-6 col-md-3 mb-4">
                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto text-dark"
                        style="width: 100px; height: 100px; font-size: 2rem;">
                        2
                    </div>
                    <p class="mt-2">Pemotretan</p>
                </div>
                <div class="col-6 col-md-3 mb-4">
                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto text-dark"
                        style="width: 100px; height: 100px; font-size: 2rem;">
                        3
                    </div>
                    <p class="mt-2">Editing</p>
                </div>
                <div class="col-6 col-md-3 mb-4">
                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto text-dark"
                        style="width: 100px; height: 100px; font-size: 2rem;">
                        4
                    </div>
                    <p class="mt-2">Kirim</p>
                </div>
            </div>
        </div>
    </section>

    <section class="services section">
        <div class="container section-title" data-aos="fade-up">
            <h2>Layanan Kami</h2>
        </div>

        <div class="container">
            <div class="row gy-4 justify-content-center">
                @forelse ($services as $service)
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-item position-relative">
                        <div class="icon">
                            <i class="bi bi-camera2"></i>
                        </div>
                        <a href="" class="stretched-link">
                            <h3>{{ $service->name }}</h3>
                        </a>
                        <p>{{ $service->description }}</p>
                        <span class="text-muted">Rp. {{ number_format($service->price, 0,'.','.') }}</span>
                    </div>
                </div>
                @empty
                <p class="text-danger text-center">Data Kosong</p>
                @endforelse
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('booking.index') }}" class="btn btn-warning text-white">BOOK NOW</a>
            </div>
        </div>
    </section>

    {{-- <section id="team" class="team section">
        <div class="container section-title" data-aos="fade-up">
            <h2>Temukan Foto Anda</h2>
        </div>

        <div class="container">
            <div class="row gy-5 justify-content-center">
                @foreach ($products as $product)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="member">
                        <div class="pic"><img src="{{ asset('storage/files/images/' . $product->image) }}"
                                class="img-fluid" alt="image {{ $product->image }}"></div>
                        <div class="member-info">
                            <h4>Rp. {{ number_format($product->price, 0, '.', '.') }}</h4>
                            <span>{{ $product->description }}</span>
                            <div class="social">
                                <form action="{{ route('cart.store', $product) }}" method="POST">
                                    @csrf
                                    <button type="submit" style="background: transparent; border: none;">
                                        <i class="bi bi-cart"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <div class="container">
        {{ $products->links() }}
    </div> --}}
</x-guest-layout>

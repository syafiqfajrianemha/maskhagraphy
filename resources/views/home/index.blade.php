<x-guest-layout>
    @push('style')
        <style>
            .image-wrap-2 {
                width: 100%;
                height: 600px; /* Ganti sesuai kebutuhan (misal: 250px, 350px, dsb) */
                position: relative;
                overflow: hidden;
                /* border-radius: 16px; */
                box-shadow: 0 4px 8px rgba(0,0,0,0.1); /* Opsional */
            }

            .image-wrap-2 img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                object-position: center;
                display: block;
            }
        </style>
    @endpush
    <div class="container-fluid" data-aos="fade" data-aos-delay="500">
      <div class="row">
        <div class="col-lg-4">

          <div class="image-wrap-2">
            <div class="image-info">
              <h2 class="mb-3">Product</h2>
              <a href="{{ route('more.photos', 'product') }}" class="btn btn-outline-white py-2 px-4">More Photos</a>
            </div>
            <img src="{{ asset('images/product.jpg') }}" alt="Image" class="img-fluid">
          </div>

        </div>
        <div class="col-lg-4">
          <div class="image-wrap-2">
            <div class="image-info">
              <h2 class="mb-3">Portrait</h2>
              <a href="{{ route('more.photos', 'potrait') }}" class="btn btn-outline-white py-2 px-4">More Photos</a>
            </div>
            <img src="{{ asset('images/potrait.jpg') }}" alt="Image" class="img-fluid">
          </div>
        </div>
        <div class="col-lg-4">
          <div class="image-wrap-2">
            <div class="image-info">
              <h2 class="mb-3">Event</h2>
              <a href="{{ route('more.photos', 'event') }}" class="btn btn-outline-white py-2 px-4">More Photos</a>
            </div>
            <img src="{{ asset('images/event.jpg') }}" alt="Image" class="img-fluid">
          </div>
        </div>

        <div class="col-lg-4">
          <div class="image-wrap-2">
            <div class="image-info">
              <h2 class="mb-3">Engagement</h2>
              <a href="{{ route('more.photos', 'engagement') }}" class="btn btn-outline-white py-2 px-4">More Photos</a>
            </div>
            <img src="{{ asset('images/engagement.jpg') }}" alt="Image" class="img-fluid">
          </div>
        </div>

        <div class="col-lg-4">
          <div class="image-wrap-2">
            <div class="image-info">
              <h2 class="mb-3">Birthday</h2>
              <a href="{{ route('more.photos', 'birthday') }}" class="btn btn-outline-white py-2 px-4">More Photos</a>
            </div>
            <img src="{{ asset('images/birthday.jpg') }}" alt="Image" class="img-fluid">
          </div>
        </div>

        <div class="col-lg-4">
          <div class="image-wrap-2">
            <div class="image-info">
              <h2 class="mb-3">Sports</h2>
              <a href="{{ route('more.photos', 'sports') }}" class="btn btn-outline-white py-2 px-4">More Photos</a>
            </div>
            <img src="{{ asset('images/sport.jpg') }}" alt="Image" class="img-fluid">
          </div>
        </div>

        <div class="col-lg-4">
          <div class="image-wrap-2">
            <div class="image-info">
              <h2 class="mb-3">Prewedding</h2>
              <a href="{{ route('more.photos', 'prewedding') }}" class="btn btn-outline-white py-2 px-4">More Photos</a>
            </div>
            <img src="{{ asset('images/prewedding.jpg') }}" alt="Image" class="img-fluid">
          </div>
        </div>

        <div class="col-lg-4">
          <div class="image-wrap-2">
            <div class="image-info">
              <h2 class="mb-3">Wedding</h2>
              <a href="{{ route('more.photos', 'wedding') }}" class="btn btn-outline-white py-2 px-4">More Photos</a>
            </div>
            <img src="{{ asset('images/wedding.jpg') }}" alt="Image" class="img-fluid">
          </div>
        </div>

        <div class="col-lg-4">
          <div class="image-wrap-2">
            <div class="image-info">
              <h2 class="mb-3">Family</h2>
              <a href="{{ route('more.photos', 'family') }}" class="btn btn-outline-white py-2 px-4">More Photos</a>
            </div>
            <img src="{{ asset('images/family.jpg') }}" alt="Image" class="img-fluid">
          </div>
        </div>

      </div>
    </div>
</x-guest-layout>

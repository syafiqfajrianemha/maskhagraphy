<x-guest-layout>
    <div class="site-section"  data-aos="fade">
      <div class="container-fluid">

        <div class="row justify-content-center">

          <div class="col-md-7">
            <div class="row mb-5">
              <div class="col-12 ">
                <h2 class="site-section-heading text-center text-capitalize">{{ $category }} Gallery</h2>
              </div>
            </div>
          </div>

        </div>
        <div class="row" id="lightgallery">
          @forelse ($portfolios as $portfolio)
                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 item" data-aos="fade" data-src="{{ asset('storage/files/images/' . $portfolio->image) }}" data-sub-html="<h4>{{ $portfolio->category }}</h4>">
                    <a href="#"><img src="{{ asset('storage/files/images/' . $portfolio->image) }}" alt="IMage" class="img-fluid"></a>
                </div>
          @empty
              <div class="col">
                <p class="text-center">Data is Empty</p>
              </div>
          @endforelse
        </div>
      </div>
    </div>
</x-guest-layout>

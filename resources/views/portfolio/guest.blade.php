<x-guest-layout>
    <div class="py-5">
        <div class="container">
            <div class="row g-4">
                <section id="portfolio" class="portfolio section">
                    <div class="container section-title" data-aos="fade-up">
                        <h2>Portofolio</h2>
                    </div>

                    <div class="container">
                        <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
                            <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
                                <li data-filter="*" class="filter-active">All</li>
                                <li data-filter=".filter-potrait">Potrait</li>
                                <li data-filter=".filter-engagement">Engagement</li>
                                <li data-filter=".filter-prewedding">Prewedding</li>
                                <li data-filter=".filter-wedding">Wedding</li>
                                <li data-filter=".filter-family">Family</li>
                                <li data-filter=".filter-product">Product</li>
                            </ul>

                            <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
                                @foreach ($portfolios as $portfolio)
                                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-{{ $portfolio->category }}">
                                        <div class="portfolio-content h-100">
                                            <img src="{{ asset('storage/files/images/' . $portfolio->image) }}" class="img-fluid" alt="">
                                            <div class="portfolio-info">
                                                <h4>{{ $portfolio->category }}</h4>
                                                <a href="{{ asset('storage/files/images/' . $portfolio->image) }}" title="{{ $portfolio->category }}" class="glightbox details-link"><i
                                                        class="bi bi-zoom-in"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-guest-layout>

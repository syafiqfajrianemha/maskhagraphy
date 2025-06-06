<x-guest-layout>
    @push('style')
        <style>
            img {
                pointer-events: none;
                -webkit-user-drag: none;
            }

            .download-btn {
                position: absolute;
                bottom: 10px;
                left: 10px;
                background-color: rgba(0, 0, 0, 0.7);
                color: white;
                padding: 5px 10px;
                border-radius: 5px;
                font-size: 12px;
                text-decoration: none;
                display: none;
                z-index: 10;
            }

            .hover-container:hover .download-btn {
                display: block;
            }

            .hover-container {
                transition: transform 0.3s ease;
            }

            .hover-container:hover {
                transform: scale(1.05);
            }

            .img-fluid-custom {
                width: 100%;
                height: 200px;
                object-fit: cover;
                border-radius: 0.5rem;
            }
        </style>
    @endpush

    <div class="container py-5">
        <div class="row g-3">
            @forelse ($collections as $collection)
                <div class="col-6 col-md-3">
                    <div class="position-relative hover-container">
                        <img src="{{ asset('storage/files/images/' . $collection->product->image) }}"
                             alt="{{ $collection->product->image }}"
                             class="img-fluid-custom shadow-sm">

                        <a href="{{ asset('storage/files/images/' . $collection->product->image) }}"
                           download="{{ $collection->product->image }}"
                           class="download-btn">
                            Download
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-danger">There is no data.</p>
                </div>
            @endforelse
        </div>
    </div>

    @push('script')
        <script>
            document.addEventListener('contextmenu', (e) => {
                e.preventDefault();
            });
        </script>
    @endpush
</x-guest-layout>

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
            }

            .hover-container:hover .download-btn {
                display: block;
            }
        </style>
    @endpush

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                @forelse ($collections as $collection)
                    <div class="relative hover-container hover:scale-105 transition duration-300">
                        <img cursor="pointer" src="{{ asset('storage/files/images/' . $collection->product->image) }}" alt="image {{ $collection->product->image }}">

                        <a href="{{ asset('storage/files/images/' . $collection->product->image) }}"
                           download="{{ $collection->product->image }}"
                           class="download-btn">
                            Download
                        </a>
                    </div>
                @empty
                    <p class="text-red-800">There is no data.</p>
                @endforelse
            </div>
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

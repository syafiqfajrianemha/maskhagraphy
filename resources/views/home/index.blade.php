<x-guest-layout>
    @push('style')
        <style>
            img {
                pointer-events: none;
                -webkit-user-drag: none;
            }
        </style>
    @endpush

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-2 hover:translate-x-400">
                @forelse ($products as $product)
                    <div class="relative hover:scale-105 transition duration-300">
                        <div class="absolute">
                            <div class="top-0 right-0 px-4 py-2 bg-black text-white rounded-b-none rounded-br-md">
                                <p>Rp. {{ number_format($product->price, 0, '.', '.') }}</p>
                            </div>
                        </div>
                        <a href="/">
                            <img src="{{ asset('storage/files/images/' . $product->image) }}" alt="image {{ $product->image }}">
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

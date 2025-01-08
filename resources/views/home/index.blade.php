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
                        <form action="{{ route('cart.store', $product) }}" method="POST">
                            @csrf
                            <button type="submit" class="absolute right-0 bottom-0 bg-black/30 hover:bg-black/50 font-bold text-white px-4 py-1 rounded-b-none rounded-tl-md">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                  </svg>
                            </button>
                        </form>
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

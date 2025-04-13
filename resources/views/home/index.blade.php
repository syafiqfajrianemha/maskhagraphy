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
            <div class="flex justify-center mb-4">
                <input type="text" id="searchInput" placeholder="Search..."
                       class="w-full md:w-1/2 border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                       value="{{ request('q') }}">
            </div>

            <div id="productGrid" class="transition duration-300 ease-in-out">
                @include('home._product-list', ['products' => $products])
            </div>
        </div>
    </div>

    @push('script')
        <script>
            function fetchProducts(url = null) {
                const query = document.getElementById('searchInput').value;
                const targetUrl = url || `{{ route('home.search') }}?q=${encodeURIComponent(query)}`;

                fetch(targetUrl, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(res => res.text())
                    .then(html => {
                        document.getElementById('productGrid').innerHTML = html;
                    })
                    .catch(() => alert('Gagal memuat produk.'));
            }

            document.addEventListener('DOMContentLoaded', function () {
                const searchInput = document.getElementById('searchInput');
                let timer;

                searchInput.addEventListener('keyup', function () {
                    clearTimeout(timer);
                    timer = setTimeout(() => {
                        fetchProducts();
                    }, 500);
                });

                document.addEventListener('click', function (e) {
                    if (e.target.closest('.pagination a')) {
                        e.preventDefault();
                        const url = e.target.closest('.pagination a').getAttribute('href');
                        fetchProducts(url);
                    }
                });
            });
        </script>
    @endpush
</x-guest-layout>

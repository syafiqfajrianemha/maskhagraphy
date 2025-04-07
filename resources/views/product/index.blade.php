<x-app-layout>
    <div id="flash-data" data-flashdata="{{ session('message') }}"></div>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="text-gray-900 flex justify-between items-center">
                        <x-primary-href :href="route('product.create')">
                            {{ __('Add Product') }}
                        </x-primary-href>

                        <select id="statusFilter" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option selected disabled>Filter by Status</option>
                            <option value="available">Available</option>
                            <option value="unavailable">Unavailable</option>
                        </select>
                    </div>

                    <div id="productList">
                        @include('product._list')
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="{{ asset('js/main.js') }}"></script>

        <script>
            $(document).ready(function() {
                $('#statusFilter').on('change', function() {
                    const status = $(this).val();

                    $.ajax({
                        url: '{{ route("product.status.filter") }}',
                        type: 'GET',
                        data: { status },
                        success: function(response) {
                            $('#productList').html(response);
                        },
                        error: function() {
                            alert('Terjadi kesalahan saat memuat data');
                        }
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>

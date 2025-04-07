<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- Ringkasan Statistik --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div class="bg-green-100 p-4 rounded shadow">
                            <h3 class="text-lg font-bold">Total Pendapatan Potensial</h3>
                            <p class="text-2xl font-semibold text-green-700">
                                Rp. {{ number_format($totalPotentialRevenue, 0, ',', '.') }}
                            </p>
                        </div>

                        <div class="bg-blue-100 p-4 rounded shadow">
                            <h3 class="text-lg font-bold">Total Pendapatan Terealisasi</h3>
                            <p class="text-2xl font-semibold text-blue-700">
                                Rp. {{ number_format($totalEarnedRevenue, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                        <div class="bg-white p-4 shadow rounded">
                            <h4 class="text-gray-500 text-sm">Total Produk</h4>
                            <p class="text-xl font-semibold">{{ $totalProducts }}</p>
                        </div>
                        <div class="bg-white p-4 shadow rounded">
                            <h4 class="text-gray-500 text-sm">Produk Terjual</h4>
                            <p class="text-xl font-semibold text-blue-600">{{ $totalSold }}</p>
                        </div>
                        <div class="bg-white p-4 shadow rounded">
                            <h4 class="text-gray-500 text-sm">Produk Tersedia</h4>
                            <p class="text-xl font-semibold text-green-600">{{ $totalAvailable }}</p>
                        </div>
                        <div class="bg-white p-4 shadow rounded">
                            <h4 class="text-gray-500 text-sm">Persentase Terjual</h4>
                            <p class="text-xl font-semibold text-indigo-600">{{ $soldPercentage }}%</p>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded shadow mb-6">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-semibold mb-4">Grafik Pendapatan</h3>

                            <form method="GET" action="{{ route('dashboard') }}" class="flex gap-2 items-center">
                                <select name="filter" onchange="this.form.submit()" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option selected disabled>Filter</option>
                                    <option value="daily" {{ request('filter') == 'daily' ? 'selected' : '' }}>Per Hari</option>
                                    <option value="weekly" {{ request('filter') == 'weekly' ? 'selected' : '' }}>Per Minggu</option>
                                    <option value="monthly" {{ request('filter') == 'monthly' ? 'selected' : '' }}>Per Bulan</option>
                                    <option value="range" {{ request('filter') == 'range' ? 'selected' : '' }}>Rentang Tanggal</option>
                                </select>

                                @if(request('filter') == 'range')
                                    <input type="date" name="start_date" value="{{ request('start_date') }}" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                    <input type="date" name="end_date" value="{{ request('end_date') }}" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                    <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded text-sm">Terapkan</button>
                                @endif
                            </form>
                        </div>

                        <canvas id="revenueChart" height="100"></canvas>
                    </div>

                    {{-- Daftar Produk --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        {{-- Produk Tersedia --}}
                        <div class="bg-white border rounded shadow p-4">
                            <h2 class="text-lg font-semibold mb-2">Produk Tersedia</h2>
                            @if ($availableProducts->count())
                                <ul class="list-disc list-inside space-y-1">
                                    @foreach($availableProducts as $product)
                                        <li>
                                            {{ $product->description ?? 'Produk #' . $product->id }} -
                                            Rp. {{ number_format($product->price, 0, ',', '.') }}
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-gray-500">Tidak ada produk tersedia.</p>
                            @endif
                        </div>

                        {{-- Produk Terjual --}}
                        <div class="bg-white border rounded shadow p-4">
                            <h2 class="text-lg font-semibold mb-2">Produk Terjual</h2>
                            @if ($soldProducts->count())
                                <ul class="list-disc list-inside space-y-1">
                                    @foreach($soldProducts as $product)
                                        <li>
                                            {{ $product->description ?? 'Produk #' . $product->id }} -
                                            Rp. {{ number_format($product->price, 0, ',', '.') }}
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-gray-500">Belum ada produk terjual.</p>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctx = document.getElementById('revenueChart').getContext('2d');
            const revenueChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($chartLabels),
                    datasets: [{
                        label: 'Pendapatan (Rp)',
                        data: @json($chartData),
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                        borderRadius: 8
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return 'Rp' + value.toLocaleString('id-ID');
                                }
                            }
                        }
                    }
                }
            });
        </script>
    @endpush
</x-app-layout>

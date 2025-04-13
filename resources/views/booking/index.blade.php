<x-guest-layout>
    <div id="flash-data" data-flashdata="{{ session('message') }}"></div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                <div>
                    <h2 class="text-xl font-semibold mb-4">Daftar Booking Kamu</h2>

                    @forelse ($bookings as $booking)
                        <div class="p-4 mb-3 border rounded-md shadow-sm bg-gray-50">
                            <p><strong>Layanan:</strong> {{ $booking->service->name }}</p>
                            <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</p>
                            <p><strong>Waktu:</strong> {{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }}-{{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }}</p>
                            <p><strong>Status:</strong> @if ($booking->status == 'waiting')
                                <span class="bg-yellow-100 py-1 px-2 rounded-md">Waiting</span>
                            @endif
                            @if ($booking->status == 'approved')
                                <span class="bg-green-100 py-1 px-2 rounded-md">Approved</span>
                            @endif
                            @if ($booking->status == 'rejected')
                                <span class="bg-red-100 py-1 px-2 rounded-md">Rejected</span>
                            @endif</p>
                            @if ($booking->note)
                                <p><strong>Catatan:</strong> {{ $booking->note ?? '-' }}</p>
                            @endif
                        </div>
                    @empty
                        <p class="text-gray-500">Belum ada booking yang kamu buat.</p>
                    @endforelse
                </div>

                <hr class="my-4">

                <div>
                    <h2 class="text-xl font-semibold mb-4">Buat Booking Baru</h2>

                    <form method="POST" action="{{ route('booking.store') }}">
                        @csrf

                        <div>
                            <x-input-label for="service_id" :value="__('Layanan')" />
                            <select name="service_id" id="service_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="" disabled selected>-- Pilih Layanan --</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                                        {{ $service->name }} - Rp{{ number_format($service->price) }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('service_id')" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="phone" :value="__('No. Telepon')" />
                            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="booking_date" :value="__('Tanggal Booking')" />
                            <x-text-input id="booking_date" name="booking_date" type="date" class="mt-1 block w-full" :value="old('booking_date')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('booking_date')" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="start_time" :value="__('Jam Mulai')" />
                            <x-text-input id="start_time" name="start_time" type="time" class="mt-1 block w-full" :value="old('start_time')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('start_time')" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="end_time" :value="__('Jam Selesai')" />
                            <x-text-input id="end_time" name="end_time" type="time" class="mt-1 block w-full" :value="old('end_time')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('end_time')" />
                        </div>

                        <div class="flex items-center mt-5">
                            <x-primary-button>{{ __('Kirim Booking') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="{{ asset('js/main.js') }}"></script>
    @endpush
</x-guest-layout>

<x-guest-layout>
    @push('style')
        <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
            <script type="text/javascript"
            src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
        <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
    @endpush

    <div id="flash-data" data-flashdata="{{ session('message') }}"></div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                <div>
                    <h2 class="text-xl font-semibold mb-4">Daftar Booking Kamu</h2>

                    @forelse ($bookings as $booking)
                        @php
                            $servicePrice = $booking->service->price;
                            $snapToken = null;

                            if ($servicePrice >= 0.01) {
                                \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
                                \Midtrans\Config::$isProduction = false;
                                \Midtrans\Config::$isSanitized = true;
                                \Midtrans\Config::$is3ds = true;

                                $params = [
                                    'transaction_details' => [
                                        'order_id' => 'ORDER-' . $booking->id . '-' . Str::random(5),
                                        'gross_amount' => $servicePrice,
                                    ],
                                    'customer_details' => [
                                        'first_name' => auth()->user()->name,
                                        'email' => auth()->user()->email,
                                    ],
                                ];

                                $snapToken = \Midtrans\Snap::getSnapToken($params);
                            }
                        @endphp
                        <div class="p-4 mb-3 border rounded-md shadow-sm bg-gray-50">
                            <p><strong>Layanan:</strong> {{ $booking->service->name }}</p>
                            <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</p>
                            <p><strong>Waktu:</strong> {{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }}-{{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }}</p>
                            <p><strong>Lokasi:</strong> {{ $booking->location }}</p>
                            <p><strong>Status:</strong> @if ($booking->status == 'waiting')
                                <span class="bg-yellow-100 py-1 px-2 rounded-md">Waiting</span>
                            @endif
                            @if ($booking->status == 'approved')
                                <span class="bg-green-100 py-1 px-2 rounded-md">Approved</span>
                            @endif
                            @if ($booking->status == 'rejected')
                                <span class="bg-red-100 py-1 px-2 rounded-md">Rejected</span>
                            @endif</p>
                            @if ($booking->status == 'approved')
                                <p><strong>Payment:</strong> {{ $booking->payment }}</p>
                            @endif
                            @if ($booking->status == 'approved' && $booking->approved_at && now()->diffInMinutes($booking->approved_at) <= 60 && $booking->payment == 'pending')
                                @if ($snapToken)
                                <button
                                    id="pay-button-{{ $booking->id }}"
                                    class="mt-2 bg-blue-400 py-1 px-2 rounded-md text-white hover:bg-blue-300"
                                    data-snap-token="{{ $snapToken }}"
                                    data-booking-id="{{ $booking->id }}"
                                >Bayar Sekarang</button>
                                @endif
                                <p id="countdown-{{ $booking->id }}" class="text-sm text-red-500 mt-1"></p>
                            @endif
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

                        <div class="mt-4">
                            <x-input-label for="location" :value="__('Lokasi')" />
                            <x-text-input id="location" name="location" type="text" class="mt-1 block w-full" :value="old('location')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('location')" />
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
        @if (isset($booking))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                @foreach ($bookings as $booking)
                    @if ($booking->status == 'approved' && $booking->payment == 'pending')
                        (function() {
                            let deadline{{ $booking->id }} = new Date("{{ $booking->approved_at->addHour() }}").getTime();
                            let countdownEl = document.getElementById("countdown-{{ $booking->id }}");
                            let btnPayment = document.getElementById("pay-button-{{ $booking->id }}");

                            if (!countdownEl) return;

                            let timer{{ $booking->id }} = setInterval(function () {
                                let now = new Date().getTime();
                                let distance = deadline{{ $booking->id }} - now;

                                if (distance < 0) {
                                    clearInterval(timer{{ $booking->id }});
                                    if (countdownEl) {
                                        countdownEl.innerHTML = "Waktu pembayaran telah habis";
                                    }
                                    if (btnPayment) {
                                        btnPayment.style.display = "none";
                                    }
                                    return;
                                }

                                let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                let seconds = Math.floor((distance % (1000 * 60)) / 1000);

                                minutes = ("0" + minutes).slice(-2);
                                seconds = ("0" + seconds).slice(-2);

                                countdownEl.innerHTML = "Sisa waktu: " + minutes + ":" + seconds;
                            }, 1000);
                        })();
                    @endif
                @endforeach
            });

            document.querySelectorAll('button[id^="pay-button-"]').forEach(function (button) {
                button.addEventListener('click', function () {
                    let snapToken = this.getAttribute('data-snap-token');
                    let bookingId = this.getAttribute('data-booking-id');

                    window.snap.pay(snapToken, {
                        onSuccess: function (result) {
                            window.location.replace(`/booking/success/${bookingId}`);
                        },
                        onPending: function (result) {
                            alert("Menunggu pembayaran...");
                            console.log(result);
                        },
                        onError: function (result) {
                            alert("Pembayaran gagal!");
                            console.log(result);
                        },
                        onClose: function () {
                            alert("Anda menutup popup sebelum menyelesaikan pembayaran.");
                        }
                    });
                });
            });
        </script>
        @endif
    @endpush
</x-guest-layout>

<x-guest-layout>
    @push('style')
        <script type="text/javascript"
            src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    @endpush

    <div id="flash-data" data-flashdata="{{ session('message') }}"></div>

    <div class="py-5">
        <div class="container">
            <div class="row g-4">
                {{-- Kiri: Daftar Booking --}}
                <div class="col-md-6">
                    <h2 class="h4 fw-bold mb-3">Daftar Booking Kamu</h2>
                    @forelse ($bookings as $booking)
                        @php
                            $fullPrice = $booking->service->price;
                            $dpPrice = $fullPrice * 0.5;

                            \sleep(1); // biar order_id tidak sama
                            \srand(); // jaga-jaga

                            // Konfigurasi Midtrans
                            \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
                            \Midtrans\Config::$isProduction = false;
                            \Midtrans\Config::$isSanitized = true;
                            \Midtrans\Config::$is3ds = true;

                            // SnapToken untuk DP
                            $paramsDp = [
                                'transaction_details' => [
                                    'order_id' => 'ORDER-DP-' . $booking->id . '-' . Str::random(5),
                                    'gross_amount' => $dpPrice,
                                ],
                                'customer_details' => [
                                    'first_name' => auth()->user()->name,
                                    'email' => auth()->user()->email,
                                ],
                            ];
                            $snapTokenDp = \Midtrans\Snap::getSnapToken($paramsDp);

                            // SnapToken untuk Full
                            $paramsFull = [
                                'transaction_details' => [
                                    'order_id' => 'ORDER-FULL-' . $booking->id . '-' . Str::random(5),
                                    'gross_amount' => $fullPrice,
                                ],
                                'customer_details' => [
                                    'first_name' => auth()->user()->name,
                                    'email' => auth()->user()->email,
                                ],
                            ];
                            $snapTokenFull = \Midtrans\Snap::getSnapToken($paramsFull);
                        @endphp

                        <div class="card mb-3">
                            <div class="card-body">
                                <p><strong>Layanan:</strong> {{ $booking->service->name }}</p>
                                <p><strong>Harga:</strong> Rp. {{ number_format($booking->service->price, 0,'.','.') }}</p>
                                <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</p>
                                <p><strong>Waktu:</strong> {{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }}</p>
                                <p><strong>Lokasi:</strong> {{ $booking->location }}</p>
                                <p><strong>Status:</strong>
                                    @if ($booking->status == 'waiting')
                                        <span class="badge bg-warning text-dark">Waiting</span>
                                    @elseif ($booking->status == 'approved')
                                        <span class="badge bg-success">Approved</span>
                                    @elseif ($booking->status == 'rejected')
                                        <span class="badge bg-danger">Rejected</span>
                                    @endif
                                </p>

                                @if ($booking->status == 'approved')
                                    <p><strong>Payment:</strong> {{ $booking->payment }}</p>
                                @endif

                                {{-- Radio Pilihan Pembayaran --}}
                                @if ($booking->status == 'approved' && $booking->approved_at && now()->diffInMinutes($booking->approved_at) <= 60 && $booking->payment == 'pending')
                                    <div class="pembayarannn">
                                        <p class="m-0 p-0">Pilih metode pembayaran:</p>

                                        <div class="form-check">
                                            <input class="form-check-input payment-option" type="radio"
                                                name="payment_option_{{ $booking->id }}" id="dpOption_{{ $booking->id }}"
                                                data-price="{{ $dpPrice }}" checked>
                                            <label class="form-check-label" for="dpOption_{{ $booking->id }}">
                                                Bayar DP 50% (Rp {{ number_format($dpPrice, 0, '.', '.') }})
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input payment-option" type="radio"
                                                name="payment_option_{{ $booking->id }}" id="fullOption_{{ $booking->id }}"
                                                data-price="{{ $fullPrice }}">
                                            <label class="form-check-label" for="fullOption_{{ $booking->id }}">
                                                Bayar Full (Rp {{ number_format($fullPrice, 0, '.', '.') }})
                                            </label>
                                        </div>
                                    </div>

                                    @if ($snapTokenDp && $snapTokenFull)
                                        <button
                                            id="pay-button-{{ $booking->id }}"
                                            class="btn btn-primary btn-sm mt-2 pay-button"
                                            data-snap-token-dp="{{ $snapTokenDp }}"
                                            data-snap-token-full="{{ $snapTokenFull }}"
                                            data-current-token="{{ $snapTokenDp }}"
                                            data-booking-id="{{ $booking->id }}"
                                        >Bayar Sekarang</button>
                                    @endif

                                    <p id="countdown-{{ $booking->id }}" class="text-danger small mt-1"></p>
                                @endif

                                @if ($booking->note)
                                    <p><strong>Catatan:</strong> {{ $booking->note }}</p>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-secondary">Belum ada booking yang kamu buat.</div>
                    @endforelse
                </div>

                {{-- Kanan: Form Booking --}}
                <div class="col-md-6">
                    <h2 class="h4 fw-bold mb-3">Buat Booking Baru</h2>
                    <form method="POST" action="{{ route('booking.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="service_id" class="form-label">Layanan</label>
                            <select class="form-select" name="service_id" id="service_id" required>
                                <option disabled selected>-- Pilih Layanan --</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                                        {{ $service->name }} - Rp{{ number_format($service->price) }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="text-danger mt-1" :messages="$errors->get('service_id')" />
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">No. Telepon</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" required>
                            <x-input-error class="text-danger mt-1" :messages="$errors->get('phone')" />
                        </div>

                        <div class="mb-3">
                            <label for="booking_date" class="form-label">Tanggal Booking</label>
                            <input type="date" class="form-control" id="booking_date" name="booking_date" value="{{ old('booking_date') }}" required>
                            <x-input-error class="text-danger mt-1" :messages="$errors->get('booking_date')" />
                        </div>

                        <div class="mb-3">
                            <label for="start_time" class="form-label">Jam Mulai</label>
                            <input type="time" class="form-control" id="start_time" name="start_time" value="{{ old('start_time') }}" required>
                            <x-input-error class="text-danger mt-1" :messages="$errors->get('start_time')" />
                        </div>

                        <div class="mb-3">
                            <label for="end_time" class="form-label">Jam Selesai</label>
                            <input type="time" class="form-control" id="end_time" name="end_time" value="{{ old('end_time') }}" required>
                            <x-input-error class="text-danger mt-1" :messages="$errors->get('end_time')" />
                        </div>

                        <div class="mb-3">
                            <label for="location" class="form-label">Lokasi</label>
                            <input type="text" class="form-control" id="location" name="location" value="{{ old('location') }}" required>
                            <x-input-error class="text-danger mt-1" :messages="$errors->get('location')" />
                        </div>

                        <button type="submit" class="btn btn-success">Kirim Booking</button>
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
                document.querySelectorAll('.payment-option').forEach(function (radio) {
                    radio.addEventListener('change', function () {
                        const bookingId = this.name.replace('payment_option_', '');
                        const selectedPrice = this.dataset.price;

                        const payBtn = document.querySelector('#pay-button-' + bookingId);
                        if (payBtn) {
                            payBtn.innerText = 'Bayar Rp ' + parseInt(selectedPrice).toLocaleString('id-ID');

                            // Ganti Snap Token berdasarkan pilihan
                            if (this.id.includes('dpOption')) {
                                payBtn.dataset.currentToken = payBtn.dataset.snapTokenDp;
                            } else {
                                payBtn.dataset.currentToken = payBtn.dataset.snapTokenFull;
                            }
                        }
                    });
                });

                @foreach ($bookings as $booking)
                    @if ($booking->status == 'approved' && $booking->payment == 'pending')
                        (function () {
                            let deadline{{ $booking->id }} = new Date("{{ $booking->approved_at->addHour() }}").getTime();
                            let countdownEl = document.getElementById("countdown-{{ $booking->id }}");
                            let btnPayment = document.getElementById("pay-button-{{ $booking->id }}");

                            if (!countdownEl) return;

                            let timer = setInterval(function () {
                                let now = new Date().getTime();
                                let distance = deadline{{ $booking->id }} - now;

                                if (distance < 0) {
                                    clearInterval(timer);
                                    countdownEl.innerHTML = "Waktu pembayaran telah habis";
                                    if (btnPayment) btnPayment.style.display = "none";
                                    return;
                                }

                                let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                let seconds = Math.floor((distance % (1000 * 60)) / 1000);
                                countdownEl.innerHTML = `Sisa waktu: ${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
                            }, 1000);
                        })();
                    @endif
                @endforeach

                document.querySelectorAll('button[id^="pay-button-"]').forEach(function (button) {
                    button.addEventListener('click', function () {
                        let snapToken = this.dataset.currentToken;
                        let bookingId = this.dataset.bookingId;

                        window.snap.pay(snapToken, {
                            onSuccess: function () {
                                window.location.replace(`/booking/success/${bookingId}`);
                            },
                            onPending: function () {
                                alert("Menunggu pembayaran...");
                            },
                            onError: function () {
                                alert("Pembayaran gagal!");
                            },
                            onClose: function () {
                                alert("Anda menutup popup sebelum menyelesaikan pembayaran.");
                            }
                        });
                    });
                });
            });
        </script>
        @endif
    @endpush
</x-guest-layout>

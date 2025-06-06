<x-guest-layout>
    @push('style')
        <script type="text/javascript"
            src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    @endpush

    <div id="flash-data" data-flashdata="{{ session('message') }}"></div>

    <div class="container py-5">
        <h2 class="mb-4 fw-bold">Your Cart</h2>

        @if ($cart && $cart->items->count())
            <div class="row g-4">
                @foreach ($cart->items as $item)
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="row g-0">
                                <div class="col-md-2">
                                    <img src="{{ asset('storage/files/images/' . $item->product->image) }}"
                                        class="img-fluid rounded-start h-100 object-fit-cover" alt="{{ $item->product->name }}">
                                </div>
                                <div class="col-md-10">
                                    <div class="card-body d-flex flex-column justify-content-between h-100">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <h5 class="card-title mb-1">{{ $item->product->name }}</h5>
                                                <p class="card-text text-muted small mb-2">{{ $item->product->description }}</p>
                                                <p class="card-text mb-1"><small class="text-muted">Qty: {{ $item->quantity }}</small></p>
                                            </div>
                                            <div class="text-end">
                                                <h6 class="text-primary">Rp. {{ number_format($item->product->price, 0, '.', '.') }}</h6>
                                                <form action="{{ route('cart.remove', $item) }}" method="POST" class="mt-2">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">Remove</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($totalPrice >= 1)
                <div class="card mt-4">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Total: Rp. {{ number_format($totalPrice, 0, '.', '.') }}</h5>
                        @if ($snapToken)
                            <button class="btn btn-success" id="payment">Proceed to Payment</button>
                        @endif
                    </div>
                </div>
            @endif
        @else
            <div class="alert alert-warning mt-4">
                Your cart is empty. <a href="{{ route('home.index') }}" class="alert-link">Shop now &rarr;</a>
            </div>
        @endif
    </div>

    @push('script')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

        <script>
            const flashData = $('#flash-data').data('flashdata');
            if (flashData) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: flashData,
                    timer: 3000,
                    showConfirmButton: false
                });
            }

            const payButton = document.getElementById('payment');
            if (payButton) {
                payButton.addEventListener('click', function () {
                    window.snap.pay('{{ $snapToken }}', {
                        onSuccess: function (result) {
                            window.location.replace("{{ route('payment.success') }}");
                        },
                        onPending: function (result) {
                            alert("Waiting for your payment!");
                            console.log(result);
                        },
                        onError: function (result) {
                            alert("Payment failed!");
                            console.log(result);
                        },
                        onClose: function () {
                            alert('You closed the popup without finishing the payment.');
                        }
                    });
                });
            }
        </script>
    @endpush
</x-guest-layout>

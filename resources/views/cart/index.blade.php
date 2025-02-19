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
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-lg font-medium text-gray-900">Your Cart</h2>

                    <div class="mt-5">
                        <ul role="list" class="-my-6 divide-y divide-gray-200">
                            @if ($cart && $cart->items->count())
                                @foreach ($cart->items as $item)
                                    <li class="flex py-6">
                                        <div class="size-24 shrink-0 overflow-hidden rounded-md border border-gray-200">
                                            <img src="{{ asset('storage/files/images/' . $item->product->image) }}"
                                                alt="image {{ $item->product->image }}" class="size-full object-cover">
                                        </div>

                                        <div class="ml-4 flex flex-1 flex-col">
                                            <div>
                                                <div class="flex justify-between text-base font-medium text-gray-900">
                                                    <h3>
                                                        <a href="#">{{ $item->product->image }}</a>
                                                    </h3>
                                                    <p class="ml-4">Rp.
                                                        {{ number_format($item->product->price, 0, '.', '.') }}
                                                    </p>
                                                </div>
                                                <p class="mt-1 text-sm text-gray-500">{{ $item->product->description }}</p>
                                            </div>
                                            <div class="flex flex-1 items-end justify-between text-sm">
                                                <p class="text-gray-500">Qty {{ $item->quantity }}</p>

                                                <div class="flex">
                                                    <form action="{{ route('cart.remove', $item) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="font-medium text-indigo-600 hover:text-indigo-500">Remove</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            @else
                                <p class="mt-10 mb-6 text-red-500">Your cart is empty. <a class="text-blue-500"
                                    href="{{ route('home.index') }}">Shop Now<span aria-hidden="true">
                                        &rarr;</span></a>
                                </p>
                            @endif
                        </ul>
                        @if ($totalPrice >= 1)
                        <div class="border-t border-gray-200 px-4 py-6 sm:px-6 mt-5">
                            <div class="flex justify-between text-base font-medium text-gray-900">
                                <p>Total</p>
                                <p>Rp. {{ number_format($totalPrice, 0, '.', '.') }}</p>
                            </div>
                            <div class="mt-6">
                                @if ($snapToken)
                                <button class="flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700" id="payment">Payment</button>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    <script type="text/javascript">
        // For example trigger on button clicked, or any time you need
        var payButton = document.getElementById('payment');
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
    </script>
    @endpush
</x-guest-layout>

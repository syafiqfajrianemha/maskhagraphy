<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function createPayment(Request $request, $cartId)
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $cart = Cart::with('cartItems.product')->findOrFail($cartId);

        $transactionDetails = [
            'order_id' => uniqid('ORDER-'),
            'gross_amount' => $cart->cartItems->sum(function ($item) {
                return $item->product->price * $item->quantity;
            }),
        ];

        $itemDetails = $cart->cartItems->map(function ($item) {
            return [
                'id' => $item->product_id,
                'price' => $item->product->price,
                'quantity' => $item->quantity,
                'name' => $item->product->name,
            ];
        })->toArray();

        $customerDetails = [
            'first_name' => $cart->user->name,
            'email' => $cart->user->email,
        ];

        $transaction = [
            'transaction_details' => $transactionDetails,
            'item_details' => $itemDetails,
            'customer_details' => $customerDetails,
        ];

        try {
            $snapToken = Snap::getSnapToken($transaction);

            return view('payment.snap', compact('snapToken'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function viewCart()
    {
        $cart = auth()->user()->cart;

        $totalPrice = $cart ? $cart->items->sum(function ($item) {
            return $item->quantity * $item->product->price;
        }) : 0;

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => Str::random(15),
                'gross_amount' => $totalPrice,
            ),
            'customer_details' => array(
                'name' => auth()->user()->name,
                'handphone' => "-",
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return view('cart.index', compact('cart', 'totalPrice', 'snapToken'));
    }

    public function updateCart(Request $request, CartItem $cartItem)
    {
        $cartItem->update(['quantity' => $request->quantity]);

        return redirect()->route('cart.index')->with('message', 'Cart updated successfully.');
    }

    public function removeFromCart(CartItem $cartItem)
    {
        $cartItem->delete();

        return redirect()->route('cart.index')->with('message', 'Product removed from cart.');
    }

    public function addToCart(Request $request, Product $product)
    {
        $cart = auth()->user()->cart()->firstOrCreate();

        $existingCartItem = $cart->items()->where('product_id', $product->id)->first();

        if ($existingCartItem) {
            return redirect()->route('cart.index');
        }

        $cart->items()->create([
            'product_id' => $product->id,
            'quantity' => 1,
        ]);

        return redirect()->route('cart.index')->with('message', 'Product added to cart.');
    }
}
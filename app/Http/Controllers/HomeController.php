<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::where('status', 'available')->latest()->paginate(20);
        return view('home.index', compact('products'));
    }

    public function search(Request $request)
    {
        $products = Product::where('status', 'available')
            ->where('description', 'like', '%' . $request->q . '%')
            ->latest()
            ->paginate(20);

        if ($request->ajax()) {
            return view('home._product-list', compact('products'))->render();
        }

        return view('home.index', compact('products'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->where('status', 'available')->get();
        return view('home.index', compact('products'));
    }
}

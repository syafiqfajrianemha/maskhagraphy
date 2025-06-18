<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::where('status', 'available')->latest()->paginate(20);
        $services = Service::latest()->get();
        return view('home.index', compact('products', 'services'));
    }

    public function search(Request $request)
    {
        $products = Product::where('status', 'available')
            ->where('description', 'like', '%' . $request->q . '%')
            ->latest()
            ->paginate(20);
        $services = Service::latest()->get();

        if ($request->ajax()) {
            return view('home._product-list', compact('products'))->render();
        }

        return view('home.index', compact('products', 'services'));
    }

    public function detailByCategory($categoryName)
    {
        $category = $categoryName;
        if ($categoryName == 'all') {
            $portfolios = Portfolio::latest()->get();
        } else {
            $portfolios = Portfolio::where('category', $categoryName)->get();
        }
        return view('home.more-photos', compact('portfolios', 'category'));
    }

    public function about()
    {
        return view('home.about');
    }
}

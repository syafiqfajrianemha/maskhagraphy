<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $limit = 10;
        $products = Product::orderBy('id', 'desc')->paginate($limit);
        $no = $limit * ($products->currentPage() - 1);
        return view('product.index', compact('products', 'no'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|mimes:png,jpg,jpeg',
            'price' => 'required|numeric',
            'description' => 'nullable',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            if ($image->isValid()) {
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('files/images', $image, $imageName);
            }
        }

        Product::create([
            'image' => $imageName,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        return redirect()->route('product.index')->with('message', 'Product has been created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable|mimes:png,jpg,jpeg',
            'price' => 'required|numeric',
            'description' => 'nullable',
        ]);

        $product = Product::findOrFail($id);

        $imageName = $product->image;

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            if ($image->isValid()) {
                if ($product->image && Storage::disk('public')->exists('files/images/' . $product->image)) {
                    Storage::disk('public')->delete('files/images/' . $product->image);
                }

                $imageName = time() . '.' . $image->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('files/images', $image, $imageName);
            }
        }

        $product->update([
            'image' => $imageName,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        return redirect()->route('product.index')->with('message', 'Product has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        File::delete('storage/files/images/' . $product->image);
        Product::destroy($product->id);

        return redirect()->route('product.index')->with('message', 'Product has been deleted');
    }

    public function statusFilter(Request $request)
    {
        $limit = 10;

        $query = Product::query();

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->description) {
            $query->where('description', 'like', '%' . $request->description . '%');
        }

        $products = $query->paginate($limit);
        $no = $limit * ($products->currentPage() - 1);

        return view('product._list', compact('products', 'no'));
    }
}

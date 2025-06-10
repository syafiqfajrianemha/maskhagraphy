<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $portfolios = Portfolio::latest()->get();
        return view('portfolio.index', compact('portfolios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('portfolio.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|mimes:png,jpg,jpeg',
            'category' => 'required|string',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            if ($image->isValid()) {
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('files/images', $image, $imageName);
            }
        }

        Portfolio::create([
            'image' => $imageName,
            'category' => $request->category,
        ]);

        return redirect()->route('portfolio.index')->with('message', 'Portfolio has been created');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        return view('portfolio.edit', compact('portfolio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable|mimes:png,jpg,jpeg',
            'category' => 'required|string',
        ]);

        $portfolio = Portfolio::findOrFail($id);

        $imageName = $portfolio->image;

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            if ($image->isValid()) {
                if ($portfolio->image && Storage::disk('public')->exists('files/images/' . $portfolio->image)) {
                    Storage::disk('public')->delete('files/images/' . $portfolio->image);
                }

                $imageName = time() . '.' . $image->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('files/images', $image, $imageName);
            }
        }

        $portfolio->update([
            'image' => $imageName,
            'category' => $request->category,
        ]);

        return redirect()->route('portfolio.index')->with('message', 'Portfolio has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $portfolio = Portfolio::find($id);

        File::delete('storage/files/images/' . $portfolio->image);
        Portfolio::destroy($portfolio->id);

        return redirect()->route('portfolio.index')->with('message', 'Portfolio has been deleted');
    }

    public function guest()
    {
        $portfolios = Portfolio::latest()->get();
        return view('portfolio.guest', compact('portfolios'));
    }
}

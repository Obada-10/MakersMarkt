<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        // $products = Product::all();
        $query = Product::query();

        foreach (['category', 'material'] as $filter) {
            if ($request->filled($filter)) {
                $query->where($filter, $request->$filter);
            }
        }
        if ($request->filled('production_time')) {
            $query->where('production_time', '<=', $request->production_time);
        }

        $products = $query->get();
        $filterOptions = Product::select('category', 'material', 'production_time')->distinct()->get();

        // dd($products);
        return view('products.index', compact('products', 'filterOptions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $filters = Product::select('category', 'material', 'complexity', 'durability')->get();
        return view('products.create', compact('filters'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'material' => 'required|string',
            'production_time' => 'required|integer|min:1',
            'complexity' => 'required|string',
            'durability' => 'required|string',
            'unique_features' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);
        $validatedData['user_id'] = auth()->id();
        // dd(auth()->id());
        // dd($validatedData,);
        Product::create($validatedData);

    return redirect()->route('products.index')->with('success', 'product toegevoegd');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $showProduct = Product::findOrFail($id);
        return view('products.show', compact('showProduct'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $productEdit = Product::findOrFail($id);
        $filtersEdit = Product::select('category', 'material', 'complexity', 'durability')->get();
        return view('products.edit', compact('filtersEdit', 'productEdit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'material' => 'required|string',
            'production_time' => 'required|integer|min:1',
            'complexity' => 'required|string',
            'durability' => 'required|string',
            'unique_features' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        $product = Product::findOrFail($id);
        $product->update($validatedData);
        return redirect()->route('products.index')->with('success', 'product bewerkt');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

    return redirect()->route('products.index')->with('product verwijderd');
    }
}

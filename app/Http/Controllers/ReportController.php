<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Report;

class ReportController extends Controller
{
    public function store(Request $request, Product $product)
    {
        if ($product->reports()->where('user_id', auth()->id())->exists()) {
            return redirect()->back()->with('error', 'Je hebt dit product al gerapporteerd.');
        }
        Report::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
        ]);
        return redirect()->back()->with('product geroporteerd');
    }

    public function index()
    {
        $products = Product::withCount('reports')->having('reports_count', '>=', 1)->get();
        return view('reports.index', compact('products'));
    }

    public function approve(Product $product)
    {
        $product->reports()->delete();
        return redirect()->back()->with('reports ongedaan gemaakt');
    }

    public function delete(Product $product)
    {
        $product->delete();
        return redirect()->back()->with('Ongepast product verwijderd');
    }
}

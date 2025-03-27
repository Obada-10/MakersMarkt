<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, Product $product)
    {
        if (Auth::user()->role !== 'koper') {
            return back()->with('error', 'Alleen kopers mogen reviews schrijven.');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('products.show', $product)->with('success', 'Review toegevoegd!');
    }

    public function edit(Review $review)
    {
        if ($review->user_id !== Auth::id()) {
            abort(403);
        }
        return view('reviews.edit', compact('review'));
    }


    public function update(Request $request, Review $review)
    {
        if ($review->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        $review->update([
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('products.show', $review->product_id)->with('success', 'Review bijgewerkt!');
    }

    public function destroy(Review $review)
    {
        if ($review->user_id !== Auth::id() && Auth::user()->role !== 'moderator') {
            abort(403, 'Je mag deze review niet verwijderen.');
        }
        $review->delete();
        return redirect()->route('products.show', $review->product_id)->with('success', 'Review verwijderd!');
    }
}

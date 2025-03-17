<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // Review opslaan
    public function store(Request $request, Product $product)
    {
        // Controleer of de gebruiker een koper is
        if (Auth::user()->role !== 'koper') {
            return back()->with('error', 'Alleen kopers mogen reviews schrijven.');
        }

        // Validatie
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        // Review opslaan
        Review::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('products.show', $product)->with('success', 'Review toegevoegd!');
    }

    // Review bewerken (form weergeven)
    public function edit(Review $review)
    {
        // Controleer of de ingelogde gebruiker de eigenaar is
        if ($review->user_id !== Auth::id()) {
            abort(403);
        }

        return view('reviews.edit', compact('review'));
    }

    // Review updaten
    public function update(Request $request, Review $review)
    {
        // Controleer of de ingelogde gebruiker de eigenaar is
        if ($review->user_id !== Auth::id()) {
            abort(403);
        }

        // Validatie
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        // Updaten
        $review->update([
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('products.show', $review->product_id)->with('success', 'Review bijgewerkt!');
    }

    // Review verwijderen
    public function destroy(Review $review)
    {
        // Controleer of de ingelogde gebruiker de eigenaar is of admin
        if ($review->user_id !== Auth::id() && Auth::user()->role !== 'moderator') {
            abort(403, 'Je mag deze review niet verwijderen.');
        }

        $review->delete();

        return redirect()->route('products.show', $review->product_id)->with('success', 'Review verwijderd!');
    }
}

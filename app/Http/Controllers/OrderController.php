<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Basket;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Order;

class OrderController extends Controller
{
    public function basket_content(Request $request)
    {
        // Haal de winkelmandgegevens van de ingelogde gebruiker op
        $basket_content = basket::where('user_id', Auth::id())->with('product')->get();
        
        return view('orders.basket', compact('basket_content'));
    }


    public function store(Request $request)
    {
        // Zorg ervoor dat het product_id aanwezig is in de request
        $productId = $request->input('product_id');
        
        if (!$productId) {
            return redirect()->back()->with('error', 'Product ID ontbreekt.');
        }
    
        // Zoek het product op basis van het product_id
        $product = Product::find($productId);
        
        if (!$product) {
            return redirect()->back()->with('error', 'Product niet gevonden.');
        }
    
        // Voeg het product toe aan de winkelmand
        Basket::create([
            'user_id' => Auth::id(),
            'product_id' => $productId
        ]);
    
        return redirect()->back()->with('success', 'Product toegevoegd aan winkelmand!');
    }






    public function checkout(Request $request)
    {
        // Haal de geselecteerde product-ID's op uit de request
        $selected_products = $request->input('selected_products');
        
        // Als er producten geselecteerd zijn
        if ($selected_products) {
            // Haal de producten op uit de database
            $products = Product::whereIn('id', $selected_products)->get();
    
            // Bereken de subtotaal door de prijzen van de geselecteerde producten op te tellen
            $subtotal = $products->sum('price');
            $shipping = 5.00; // Verzendkosten
            $total = $subtotal + $shipping; // Totale prijs
    
            // Geef de variabelen door aan de view
            return view('orders.checkout', compact('products', 'subtotal', 'shipping', 'total'));
        }
    
        // Als er geen producten geselecteerd zijn, stuur de gebruiker naar de winkelmandpagina
        return redirect()->route('basket.index');
    }


    
    // OrderController.php

    public function showCheckout()
    {
        // Example of how the total might be calculated based on selected products
        $basketContent = Basket::where('user_id', Auth::id())->get();
        $subtotal = $basketContent->sum(function($item) {
            return $item->product->price;
        });
        $shipping = 5.00; // Example shipping cost
        $total = $subtotal + $shipping;
    
        // Pass the total to the view
        return view('orders.checkout', compact('total'));
    }
    

public function processCheckout(Request $request)
{
    // Valideer de ingevoerde gegevens
    $request->validate([
        'name' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'street_name' => 'required|string|max:255',
        'postal_code' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'phone_number' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'total_price' => 'required|numeric',
    ]);

    // Haal de producten uit de winkelmand van de ingelogde gebruiker
    $basketContent = Basket::where('user_id', Auth::id())->get();

    // Controleer of er producten in de winkelmand zitten
    if ($basketContent->isEmpty()) {
        return redirect()->route('orders.basket')->with('error', 'Je winkelmand is leeg.');
    }

    // Haal het eerste basket_id op (aangezien alle items van dezelfde gebruiker zijn)
    $basketId = $basketContent->first()->id ?? null;

    // Maak de bestelling aan
    $order = Order::create([
        'user_id' => Auth::id(),
        'basket_id' => $basketId, // Zorgt ervoor dat er een basket_id wordt meegegeven
        'name' => $request->name,
        'address' => $request->address,
        'street_name' => $request->street_name,
        'postal_code' => $request->postal_code,
        'city' => $request->city,
        'phone_number' => $request->phone_number,
        'email' => $request->email,
        'total_price' => $request->total_price,
        'status' => 'In productie',  
        'status_description' => 'Product wordt momenteel gemaakt',
    ]);

    // Voeg de producten toe aan de bestelling via de pivot-tabel
    foreach ($basketContent as $item) {
        $order->products()->attach($item->product_id);
    }

    // Verwijder de producten uit de winkelmand nadat de bestelling is geplaatst

    // Redirect naar een succespagina
    return redirect()->route('orders.basket')->with('success', 'Bestelling succesvol geplaatst!');
}


public function bestelling()
{
    if (auth()->user()->role === 'moderator') {
        $orders = Order::all();
    } else {
        $orders = Order::where('user_id', Auth::id())->get();
    }

    return view('orders.bestelling', compact('orders'));
}



public function updateStatus(Request $request, Order $order)
{
    $request->validate([
        'status' => 'required|in:In productie,Verzonden,Geweigerd',
    ]);

    $order->update(['status' => $request->status]);

    return redirect()->back()->with('success', 'Bestelstatus bijgewerkt!');
}


}
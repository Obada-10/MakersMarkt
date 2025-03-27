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
        $basket_content = basket::where('user_id', Auth::id())->with('product')->get();
        
        return view('orders.basket', compact('basket_content'));
    }

    public function store(Request $request)
    {
        $productId = $request->input('product_id');
        
        if (!$productId) {
            return redirect()->back()->with('error', 'Product ID ontbreekt.');
        }
    
        $product = Product::find($productId);
        
        if (!$product) {
            return redirect()->back()->with('error', 'Product niet gevonden.');
        }
    
        Basket::create([
            'user_id' => Auth::id(),
            'product_id' => $productId
        ]);
    
        return redirect()->back()->with('success', 'Product toegevoegd aan winkelmand!');
    }

    public function checkout(Request $request)
    {
        $selected_products = $request->input('selected_products');
        
        if ($selected_products) {
            $products = Product::whereIn('id', $selected_products)->get();
                $subtotal = $products->sum('price');
            $shipping = 5.00;
            $total = $subtotal + $shipping;
    
            return view('orders.checkout', compact('products', 'subtotal', 'shipping', 'total'));
        }
    
        return redirect()->route('basket.index');
    }

    public function showCheckout()
    {
        $basketContent = Basket::where('user_id', Auth::id())->get();
        $subtotal = $basketContent->sum(function($item) {
            return $item->product->price;
        });
        $shipping = 5.00; 
        $total = $subtotal + $shipping;

        return view('orders.checkout', compact('total'));
    }
    

public function processCheckout(Request $request)
{
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

    $basketContent = Basket::where('user_id', Auth::id())->get();

    if ($basketContent->isEmpty()) {
        return redirect()->route('orders.basket')->with('error', 'Je winkelmand is leeg.');
    }

    $basketId = $basketContent->first()->id ?? null;

    $order = Order::create([
        'user_id' => Auth::id(),
        'basket_id' => $basketId,
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

    foreach ($basketContent as $item) {
        $order->products()->attach($item->product_id);
    }

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
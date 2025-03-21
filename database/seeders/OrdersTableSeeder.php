<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;

class OrdersTableSeeder extends Seeder
{
    public function run()
    {
        // Maak eerst de bestelling aan zonder product_id
        $order = Order::create([
            'user_id' => 2,
            'basket_id' => 1,
            'status' => 'In productie',
            'status_description' => 'Product wordt momenteel gemaakt',
            'name' => 'Jan Janssen',
            'address' => 'Kerkstraat 1',
            'street_name' => 'Kerkstraat',
            'postal_code' => '1234 AB',
            'city' => 'Amsterdam',
            'phone_number' => '0612345678',
            'email' => 'oooamajd@gmail.com',
            'total_price' => 100.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        // Voeg producten toe aan de bestelling via de pivot-tabel
        $order->products()->attach(1); // Hier voeg je de product_id toe (bijvoorbeeld 1)
    }
    
}


<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;

class OrdersTableSeeder extends Seeder
{
    public function run()
    {
        Order::insert([
            [
                'user_id' => 2,
                'product_id' => 1,
                'status' => 'In productie',
                'status_description' => 'Product wordt momenteel gemaakt',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}


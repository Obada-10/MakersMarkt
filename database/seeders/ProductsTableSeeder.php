<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        Product::insert([
            [
                'user_id' => 1,
                'name' => 'Handgemaakte Ring',
                'description' => 'Een prachtige zilveren ring met edelsteen.',
                'category' => 'Sieraden',
                'material' => 'Zilver',
                'production_time' => 7,
                'complexity' => 'Gemiddeld',
                'durability' => 'Langdurig',
                'unique_features' => 'Handgegraveerd',
                'price' => 99.99,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        Product::factory()->count(10)->create();
    }
}

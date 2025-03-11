<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;

class ReviewsTableSeeder extends Seeder
{
    public function run()
    {
        Review::insert([
            [
                'user_id' => 2,
                'product_id' => 1,
                'rating' => 5,
                'comment' => 'Geweldige kwaliteit en uniek ontwerp!',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}


<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Credit;

class CreditsTableSeeder extends Seeder
{
    public function run()
    {
        Credit::insert([
            [
                'user_id' => 2,
                'balance' => 50.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}


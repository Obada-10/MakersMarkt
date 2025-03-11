<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Moderation;

class ModerationsTableSeeder extends Seeder
{
    public function run()
    {
        Moderation::insert([
            [
                'moderator_id' => 3,
                'product_id' => 1,
                'action' => 'Gecontroleerd',
                'reason' => 'Product voldoet aan de richtlijnen',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}


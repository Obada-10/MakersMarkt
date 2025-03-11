<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profile;

class ProfilesTableSeeder extends Seeder
{
    public function run()
    {
        Profile::insert([
            [
                'user_id' => 1,
                'name' => 'Maker Eén',
                'bio' => 'Ik maak handgemaakte sieraden',
                'profile_picture' => 'maker1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'name' => 'Koper Eén',
                'bio' => 'Ik koop unieke handgemaakte producten',
                'profile_picture' => 'koper1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}


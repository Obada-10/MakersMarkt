<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::insert([
            [
                'name' => 'maker1',
                'email' => 'maker1@example.com',
                'password' => Hash::make('password'),
                'role' => 'maker',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'koper1',
                'email' => 'koper1@example.com',
                'password' => Hash::make('password'),
                'role' => 'koper',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'moderator1',
                'email' => 'moderator1@example.com',
                'password' => Hash::make('password'),
                'role' => 'moderator',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}


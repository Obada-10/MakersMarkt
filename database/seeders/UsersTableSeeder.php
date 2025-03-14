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
                'name' => 'maker1', // Aangepast naar 'name' in plaats van 'username'
                'email' => 'maker1@example.com',
                'password' => Hash::make('password'),
                'role' => 'maker',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'koper1', // Aangepast naar 'name' in plaats van 'username'
                'email' => 'koper1@example.com',
                'password' => Hash::make('password'),
                'role' => 'koper',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'moderator1', // Aangepast naar 'name' in plaats van 'username'
                'email' => 'moderator1@example.com',
                'password' => Hash::make('password'),
                'role' => 'moderator',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

<?php

// membuat seeder
// php artisan make:seeder AdminSeeder

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    // public function run(): void
    // {
    //     User::create([
    //         'name' => 'Admin',
    //         'email' => 'admin@gmail.com',
    //         'password' => Hash::make('12345678'),
    //         'role' => 'admin'
    //     ]);
    // }
    public function run(): void
    {
        User::create([
            'name' => 'Staff',
            'email' => 'staff@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'staff'
        ]);
    }
}

// untuk ke databasenya pakai perintah 
// php artisan db:seed --class=AdminSeeder
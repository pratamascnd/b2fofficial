<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; 

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Masukkan password polos saja, karena di Model sudah ada cast 'hashed'
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => 'password123', // Cukup begini
            'role' => 'Super Admin',
        ]);

        User::create([
            'name' => 'Admin Staff',
            'email' => 'admin@gmail.com',
            'password' => 'password123', // Cukup begini
            'role' => 'Admin',
        ]);
    }
}
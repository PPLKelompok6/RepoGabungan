<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat akun dokter
        User::create([
            'name' => 'Dokter',
            'email' => 'dokter@example.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // Buat akun pasien
        User::create([
            'name' => 'Pasien',
            'email' => 'pasien@example.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);
    }
}

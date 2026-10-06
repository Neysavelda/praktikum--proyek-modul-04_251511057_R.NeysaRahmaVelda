<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'username' => 'budi',
            'password' => 'password123',
            'nama_lengkap' => 'Budi Santoso',
        ]);

        User::create([
            'username' => 'siti',
            'password' => 'password123',
            'nama_lengkap' => 'Siti Aminah',
        ]);
    }
}
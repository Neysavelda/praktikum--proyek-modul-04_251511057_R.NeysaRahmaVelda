<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleDemoSeeder extends Seeder
{
    public function run(): void
    {
        $akun = [
            ['id_user' => 'ADM001', 'username' => 'admin', 'nama_lengkap' => 'Admin Toko',   'email' => 'admin@example.com', 'role' => 'admin'],
            ['id_user' => 'STF001', 'username' => 'sari',  'nama_lengkap' => 'Sari Staff',   'email' => 'sari@example.com',  'role' => 'staff'],
            ['id_user' => 'USR002', 'username' => 'wati',  'nama_lengkap' => 'Wati Customer','email' => 'wati@example.com',  'role' => 'customer'],
        ];

        foreach ($akun as $a) {
            $user = User::firstOrNew(['username' => $a['username']]);
            $user->forceFill([
                'id_user'      => $a['id_user'],
                'nama_lengkap' => $a['nama_lengkap'],
                'email'        => $a['email'],
                'password'     => Hash::make('Toko#Demo2026'),
                'no_hp'        => '081200000000',
                'alamat'       => 'Bandung',
                'role'         => $a['role'],
            ])->save();
        }
    }
}
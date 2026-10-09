<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
       User::create([
            'id_user' => 'USR001',
            'nama_lengkap' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'username' => 'budi',
            'password' => Hash::make('rahasia123!'),
            'no_hp' => '081234567890',
            'alamat' => 'Jl. Gegerkalongsari No. 10, Bandung'
        ]);

        $barang = [
            ['BRG01', 'Buku Tulis A5', 'Buku tulis isi 38 lembar', 5000, 15, 'buku.png'],
            ['BRG02', 'Pulpen Gel Hitam', 'Pulpen gel 0.5mm tebal', 3500, 20, 'pulpen.png'],
            ['BRG03', 'Penggaris 30cm', 'Penggaris besi tahan patah', 6000, 8, 'penggaris.png'],
            ['BRG04', 'Pensil 2B Castelli', 'Pensil komputer isi 12', 2500, 0, 'pensil.png'],
            ['BRG05', 'Penghapus Karet', 'Penghapus putih bersih', 2000, 25, 'penghapus.png'],
            ['BRG06', 'Tipe-X Kertas', 'Correction tape 12m', 8500, 10, 'tipex.png'],
            ['BRG07', 'Spidol Permanent', 'Spidol hitam tahan air', 7000, 12, 'spidol.png'],
            ['BRG08', 'Map Snelhecter', 'Map plastik kancing', 4500, 18, 'map.png'],
            ['BRG09', 'Sticky Notes', 'Catatan tempel warna-warni', 9000, 5, 'notes.png'],
            ['BRG10', 'Gunting Kertas', 'Gunting stainless medium', 11000, 7, 'gunting.png'],
        ];

        foreach ($barang as $b) {
            Product::create([
                'id_barang' => $b[0], 'nama_barang' => $b[1], 'deskripsi' => $b[2],
                'harga' => $b[3], 'stok' => $b[4], 'gambar' => $b[5]
            ]);
        }
    }
}
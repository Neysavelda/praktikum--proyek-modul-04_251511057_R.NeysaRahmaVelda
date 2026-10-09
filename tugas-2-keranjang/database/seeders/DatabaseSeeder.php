<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Produk::create(['nama' => 'Buku Tulis', 'harga' => 5000, 'stok' => 10]);
        Produk::create(['nama' => 'Pulpen', 'harga' => 3000, 'stok' => 15]);
        Produk::create(['nama' => 'Penggaris', 'harga' => 4000, 'stok' => 8]);
        Produk::create(['nama' => 'Pensil 2B', 'harga' => 2500, 'stok' => 20]);
        Produk::create(['nama' => 'Penghapus', 'harga' => 1500, 'stok' => 12]);
    }
}
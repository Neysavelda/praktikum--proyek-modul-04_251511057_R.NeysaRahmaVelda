<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    public function index()
    {
        $produks = Produk::all();
        $keranjang = session()->get('keranjang', []);
        $totalItem = array_sum($keranjang);

        return view('index', compact('produks', 'totalItem'));
    }

    public function tambah($id)
    {
        $keranjang = session()->get('keranjang', []);
        $keranjang[$id] = ($keranjang[$id] ?? 0) + 1;
        session()->put('keranjang', $keranjang);

        return redirect()->back();
    }

    public function keranjang()
    {
        $sessionKeranjang = session()->get('keranjang', []);
        $items = [];
        $total = 0;

        if (!empty($sessionKeranjang)) {
            $produks = Produk::whereIn('id', array_keys($sessionKeranjang))->get();
            foreach ($produks as $p) {
                $jumlah = $sessionKeranjang[$p->id];
                $subtotal = $p->harga * $jumlah;
                $total += $subtotal;

                $items[] = [
                    'id' => $p->id,
                    'nama' => $p->nama,
                    'harga' => $p->harga,
                    'jumlah' => $jumlah,
                    'subtotal' => $subtotal
                ];
            }
        }

        return view('keranjang', compact('items', 'total'));
    }

    public function ubah(Request $request, $id)
    {
        $keranjang = session()->get('keranjang', []);
        if (isset($keranjang[$id])) {
            if ($request->aksi === 'tambah') {
                $keranjang[$id]++;
            } elseif ($request->aksi === 'kurang') {
                $keranjang[$id]--;
                if ($keranjang[$id] <= 0) {
                    unset($keranjang[$id]);
                }
            }
            session()->put('keranjang', $keranjang);
        }
        return redirect()->back();
    }

    public function hapus($id)
    {
        $keranjang = session()->get('keranjang', []);
        if (isset($keranjang[$id])) {
            unset($keranjang[$id]);
            session()->put('keranjang', $keranjang);
        }
        return redirect()->back();
    }

    public function kosongkan()
    {
        session()->forget('keranjang');
        return redirect()->back();
    }
}
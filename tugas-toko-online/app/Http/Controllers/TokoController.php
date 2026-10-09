<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TokoController extends Controller
{
    public function index() {
        $products = Product::all();
        return view('toko.index', compact('products'));
    }

    public function loginForm() { 
        if (Auth::check()) {
            return redirect('/');
        }
        return view('toko.login'); 
    }

    public function loginProcess(Request $request) {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = \App\Models\User::where('username', $request->username)->first();

        if ($user && \Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
            // Login-kan user secara eksplisit ke session Laravel
            Auth::login($user);
            $request->session()->regenerate();
            return redirect('/');
        }

        return back()->withErrors(['error' => 'Username atau password salah.']);
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function tambahKeranjang($id) {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu untuk belanja.');
        }

        $product = Product::findOrFail($id);
        if ($product->stok <= 0) {
            return back()->with('error', 'Stok barang habis!');
        }

        $cart = session()->get('cart', []);
        $qtySekarang = $cart[$id] ?? 0;

        if ($qtySekarang + 1 > $product->stok) {
            return back()->with('error', 'Jumlah melebihi stok tersedia!');
        }

        $cart[$id] = $qtySekarang + 1;
        session()->put('cart', $cart);

        return back()->with('success', 'Berhasil ditambahkan ke keranjang.');
    }

    public function keranjang() {
        if (!Auth::check()) return redirect('/login');

        $cart = session()->get('cart', []);
        $items = [];
        $total = 0;

        if (!empty($cart)) {
            $products = Product::whereIn('id_barang', array_keys($cart))->get();
            foreach ($products as $p) {
                $qty = $cart[$p->id_barang];
                $subtotal = $p->harga * $qty;
                $total += $subtotal;
                $items[] = ['product' => $p, 'qty' => $qty, 'subtotal' => $subtotal];
            }
        }
        return view('toko.keranjang', compact('items', 'total'));
    }

    public function ubahKeranjang(Request $request, $id) {
        if (!Auth::check()) return redirect('/login');

        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);
        $qty = (int)$request->qty;

        if ($qty > $product->stok) {
            return back()->with('error', 'Jumlah tidak boleh melebihi stok!');
        }

        if ($qty <= 0) {
            unset($cart[$id]);
        } else {
            $cart[$id] = $qty;
        }

        session()->put('cart', $cart);
        return back();
    }

    public function hapusKeranjang($id) {
        if (!Auth::check()) return redirect('/login');

        $cart = session()->get('cart', []);
        unset($cart[$id]);
        session()->put('cart', $cart);
        return back();
    }

    public function checkout() {
        if (!Auth::check()) return redirect('/login');

        $cart = session()->get('cart', []);
        if (empty($cart)) return redirect('/');

        $user = Auth::user();
        $products = Product::whereIn('id_barang', array_keys($cart))->get();
        $total = 0;

        foreach ($products as $p) {
            if ($cart[$p->id_barang] > $p->stok) {
                return redirect('/keranjang')->with('error', "Stok {$p->nama_barang} tidak mencukupi.");
            }
            $total += $p->harga * $cart[$p->id_barang];
        }

        $idOrder = 'ORD' . time();
        Order::create([
            'id_order' => $idOrder,
            'id_user' => $user->id_user,
            'tanggal_order' => now(),
            'total_harga' => $total,
            'alamat_pengiriman' => $user->alamat
        ]);

        foreach ($products as $p) {
            $qty = $cart[$p->id_barang];
            OrderDetail::create([
                'id_order' => $idOrder,
                'id_barang' => $p->id_barang,
                'harga_satuan' => $p->harga,
                'jumlah_beli' => $qty
            ]);
            $p->decrement('stok', $qty);
        }

        session()->forget('cart');
        return redirect('/pesanan')->with('success', 'Checkout berhasil! Pesanan Anda sedang diproses.');
    }

    public function riwayatPesanan() {
        if (!Auth::check()) return redirect('/login');

        $orders = Order::where('id_user', Auth::user()->id_user)
                       ->with('details.product')
                       ->orderBy('tanggal_order', 'desc')
                       ->get();
        return view('toko.pesanan', compact('orders'));
    }
}
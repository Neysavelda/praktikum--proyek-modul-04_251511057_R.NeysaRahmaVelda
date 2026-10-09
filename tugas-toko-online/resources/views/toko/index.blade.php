<!DOCTYPE html>
<html>
<head>
    <title>Toko Online</title>
    <style>
        body { font-family: sans-serif; padding: 20px; background: #f4f4f4; }
        .nav { display: flex; justify-content: space-between; background: #333; color: white; padding: 10px 20px; border-radius: 5px; }
        .nav a { color: white; text-decoration: none; margin-left: 15px; }
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 15px; margin-top: 20px; }
        .card { background: white; padding: 15px; border-radius: 5px; text-align: center; border: 1px solid #ccc; }
        .btn { background: #28a745; color: white; border: none; padding: 8px 12px; text-decoration: none; border-radius: 3px; display: inline-block; cursor: pointer; }
        .btn-disabled { background: #888; cursor: not-allowed; }
        .alert { padding: 10px; background: #d4edda; color: #155724; border-radius: 4px; margin-top: 10px; }
    </style>
</head>
<body>
    <div class="nav">
        <h2>Toko Online Praktikum</h2>
        <div>
            <a href="/">Katalog Barang</a>
            @if(Auth::check())
                <a href="/keranjang">Keranjang</a>
                <a href="/pesanan">Riwayat Pesanan</a>
                <span style="margin-left: 15px; color: #ffc107;"><b>({{ Auth::user()->nama_lengkap }})</b></span>
                <form action="/logout" method="POST" style="display:inline; margin-left:10px;">
                    @csrf 
                    <button type="submit" style="background:red; color:white; border:none; padding:4px 8px; border-radius:3px; cursor:pointer;">Logout</button>
                </form>
            @else
                <a href="/login">Login</a>
            @endif
        </div>
    </div>>

    @if(session('success')) <div class="alert">{{ session('success') }}</div> @endif
    @if(session('error')) <div class="alert" style="background:#f8d7da;color:#721c24;">{{ session('error') }}</div> @endif

    <h3>Daftar Produk</h3>
    <div class="grid">
        @foreach($products as $p)
            <div class="card">
                <img src="{{ asset('images/' . str_replace('.jpg', '.png', $p->gambar)) }}" alt="{{ $p->nama_barang }}" style="width: 100%; height: 130px; object-fit: cover; border-radius: 4px; margin-bottom: 10px;">
                <p>{{ $p->deskripsi }}</p>
                <p><strong>Rp {{ number_format($p->harga, 0, ',', '.') }}</strong></p>
                <p>Stok: {{ $p->stok }}</p>
                @if($p->stok > 0)
                    <a href="/tambah-keranjang/{{ $p->id_barang }}" class="btn">Beli / Keranjang</a>
                @else
                    <button class="btn btn-disabled" disabled>Stok Habis</button>
                @endif
            </div>
        @endforeach
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Toko Alat Tulis</title>
    <style>
        body { font-family: sans-serif; padding: 20px; background: #f9f9f9; }
        .header { display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #ccc; padding-bottom: 10px; }
        .item { background: #fff; border: 1px solid #ddd; padding: 10px; margin: 10px 0; display: flex; justify-content: space-between; align-items: center; border-radius: 5px; }
        a.btn { background: #007bff; color: white; padding: 6px 12px; text-decoration: none; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Toko Alat Tulis</h2>
        <a href="/keranjang" class="btn">Keranjang ({{ $totalItem }})</a>
    </div>
    <h3>Daftar barang</h3>
    @foreach($produks as $p)
        <div class="item">
            <div>
                <strong>{{ $p->nama }}</strong><br>
                Rp {{ number_format($p->harga, 0, ',', '.') }}
            </div>
            <a href="/tambah/{{ $p->id }}" class="btn">Masukkan ke krj</a>
        </div>
    @endforeach
</body>
</html>
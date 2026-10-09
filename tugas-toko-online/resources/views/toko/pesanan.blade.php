<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Pesanan</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        .order-card { background: #f9f9f9; border: 1px solid #ddd; margin-bottom: 20px; padding: 15px; border-radius: 5px; }
    </style>
</head>
<body>
    <a href="/">&laquo; Kembali ke Katalog</a>
    <h2>Riwayat Pesanan Saya</h2>

    @foreach($orders as $o)
        <div class="order-card">
            <h4>ID Order: {{ $o->id_order }} ({{ $o->tanggal_order }})</h4>
            <p>Alamat Pengiriman: {{ $o->alamat_pengiriman }}</p>
            <ul>
                @foreach($o->details as $d)
                    <li>{{ $d->product->nama_barang }} - {{ $d->jumlah_beli }} x Rp {{ number_format($d->harga_satuan, 0, ',', '.') }}</li>
                @endforeach
            </ul>
            <strong>Total Bayar: Rp {{ number_format($o->total_harga, 0, ',', '.') }}</strong>
        </div>
    @endforeach
</body>
</html>
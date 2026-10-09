<!DOCTYPE html>
<html>
<head>
    <title>Keranjang Belanja</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <a href="/">&laquo; Kembali ke Katalog</a>
    <h2>Keranjang Belanja Anda</h2>

    @if(empty($items))
        <p>Keranjang kosong.</p>
    @else
        <table>
            <tr><th>Produk</th><th>Harga</th><th>Jumlah</th><th>Subtotal</th><th>Aksi</th></tr>
            @foreach($items as $i)
                <tr>
                    <td>{{ $i['product']->nama_barang }}</td>
                    <td>Rp {{ number_format($i['product']->harga, 0, ',', '.') }}</td>
                    <td>
                        <form action="/ubah-keranjang/{{ $i['product']->id_barang }}" method="POST">
                            @csrf
                            <input type="number" name="qty" value="{{ $i['qty'] }}" min="1" max="{{ $i['product']->stok }}">
                            <button type="submit">Update</button>
                        </form>
                    </td>
                    <td>Rp {{ number_format($i['subtotal'], 0, ',', '.') }}</td>
                    <td><a href="/hapus-keranjang/{{ $i['product']->id_barang }}" style="color:red;">Hapus</a></td>
                </tr>
            @endforeach
        </table>
        <h3>Total Bayar: Rp {{ number_format($total, 0, ',', '.') }}</h3>

        <form action="/checkout" method="POST">
        @csrf
        <button type="submit" style="background:#28a745; color:white; padding:10px 20px; border:none; border-radius:4px; cursor:pointer;">
            Proses Checkout
        </button>
    </form>
    @endif
</body>
</html>
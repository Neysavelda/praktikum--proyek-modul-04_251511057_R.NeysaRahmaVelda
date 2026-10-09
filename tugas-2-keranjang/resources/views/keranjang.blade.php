<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Keranjang Belanja</title>
    <style>
        body { font-family: sans-serif; padding: 20px; background: #f9f9f9; }
        table { width: 100%; background: #fff; border-collapse: collapse; margin-bottom: 15px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .btn-sm { padding: 2px 8px; text-decoration: none; color: white; border-radius: 3px; border: none; cursor: pointer; }
        .btn-plus { background: #28a745; }
        .btn-minus { background: #ffc107; color: black; }
        .btn-del { background: #dc3545; }
        .actions { display: flex; gap: 5px; align-items: center; }
    </style>
</head>
<body>
    <h2>Keranjang Belanja</h2>
    <p><em>Tanpa login</em> | <a href="/index">Kembali ke Toko</a></p>

    @if(empty($items))
        <p>Keranjang kosong.</p>
    @else
        <table>
            @foreach($items as $item)
                <tr>
                    <td><strong>{{ $item['nama'] }}</strong></td>
                    <td>Rp {{ number_format($item['harga'], 0, ',', '.') }} x {{ $item['jumlah'] }} = <strong>Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</strong></td>
                    <td width="150">
                        <div class="actions">
                            <form action="/ubah/{{ $item['id'] }}" method="POST" style="display:inline;">
                                @csrf
                                <input type="hidden" name="aksi" value="kurang">
                                <button type="submit" class="btn-sm btn-minus">-</button>
                            </form>
                            <span>{{ $item['jumlah'] }}</span>
                            <form action="/ubah/{{ $item['id'] }}" method="POST" style="display:inline;">
                                @csrf
                                <input type="hidden" name="aksi" value="tambah">
                                <button type="submit" class="btn-sm btn-plus">+</button>
                            </form>
                            <a href="/hapus/{{ $item['id'] }}" class="btn-sm btn-del">hps</a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>
        <h3>Total: Rp {{ number_format($total, 0, ',', '.') }}</h3>
        <a href="/kosongkan" class="btn-sm btn-del" style="padding: 8px 12px; display:inline-block;">Kosongkan keranjang</a>
    @endif
</body>
</html>
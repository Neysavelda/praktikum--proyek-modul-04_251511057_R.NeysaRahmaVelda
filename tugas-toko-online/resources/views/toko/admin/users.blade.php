<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Role Pengguna</title>
</head>
<body style="font-family: sans-serif; padding: 20px;">
    <a href="/">« Kembali ke Katalog</a>
    <h1>Kelola Role Pengguna</h1>

    @if (session('status'))
        <p style="color: green; font-weight: bold;">{{ session('status') }}</p>
    @endif
    @if ($errors->any())
        <p style="color: red; font-weight: bold;">{{ $errors->first() }}</p>
    @endif

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th>ID User</th>
                <th>Username</th>
                <th>Nama Lengkap</th>
                <th>Role Saat Ini</th>
                <th>Aksi Ubah Role</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $u)
            <tr>
                <td>{{ $u->id_user }}</td>
                <td>{{ $u->username }}</td>
                <td>{{ $u->nama_lengkap }}</td>
                <td><strong>{{ $u->role }}</strong></td>
                <td>
                    <form method="POST" action="{{ route('admin.users.role.update', $u) }}">
                        @csrf
                        @method('PATCH')
                        <select name="role">
                            <option value="customer" @selected($u->role === 'customer')>customer</option>
                            <option value="staff" @selected($u->role === 'staff')>staff</option>
                        </select>
                        <button type="submit">Simpan</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
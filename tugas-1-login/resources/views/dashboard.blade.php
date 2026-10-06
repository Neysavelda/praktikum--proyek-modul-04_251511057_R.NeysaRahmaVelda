<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <style>
        body { font-family: sans-serif; background: #f3f4f6; margin: 0; }
        header { background: #fff; padding: 16px 32px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 1px 4px rgba(0,0,0,.1); }
        header h1 { margin: 0; font-size: 20px; }
        main { padding: 32px; }
        button { padding: 8px 16px; background: #dc2626; color: #fff; border: 0; border-radius: 4px; cursor: pointer; }
    </style>
</head>
<body>
    <header>
        <h1>Dashboard</h1>
        <form method="POST" action="/logout">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </header>
    <main>
        <h2>Selamat datang, {{ $user->nama_lengkap }}!</h2>
        <p>Halaman ini hanya bisa dibuka setelah login.</p>
        <p>Username: {{ $user->username }}</p>
    </main>
</body>
</html>
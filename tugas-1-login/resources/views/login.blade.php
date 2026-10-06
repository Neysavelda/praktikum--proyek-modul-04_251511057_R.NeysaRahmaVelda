<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <style>
        body { font-family: sans-serif; background: #f3f4f6; display: flex; justify-content: center; padding-top: 80px; }
        .card { background: #fff; padding: 32px; width: 340px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,.1); }
        h1 { margin: 0 0 4px; }
        p.sub { margin: 0 0 20px; color: #666; }
        label { display: block; margin: 12px 0 4px; font-weight: bold; }
        input { width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        button { margin-top: 20px; width: 100%; padding: 10px; background: #2563eb; color: #fff; border: 0; border-radius: 4px; cursor: pointer; }
        .error { background: #fee2e2; color: #b91c1c; padding: 8px 12px; border-radius: 4px; margin-bottom: 8px; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Login</h1>
        <p class="sub">Masuk untuk membuka dashboard</p>

        @if ($errors->any())
            <div class="error">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="/login">
            @csrf
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="{{ old('username') }}" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Masuk</button>
        </form>
    </div>
</body>
</html>
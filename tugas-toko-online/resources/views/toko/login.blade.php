<!DOCTYPE html>
<html>
<head><title>Login Toko Online</title></head>
<body style="font-family:sans-serif; display:flex; justify-content:center; align-items:center; height:100vh; background:#f4f4f4;">
    <div style="background:#fff; padding:25px; border:1px solid #ccc; border-radius:8px; width:300px;">
        <h3>Login Pengguna</h3>
        @if($errors->any()) 
            <p style="color:red; background:#ffe6e6; padding:8px; border-radius:4px; font-size:14px;">{{ $errors->first() }}</p> 
        @endif
        <form action="/login" method="POST">
            @csrf
            <p>Username:<br><input type="text" name="username" style="width:100%; padding:6px; margin-top:4px;" required autofocus></p>
            <p>Password:<br><input type="password" name="password" style="width:100%; padding:6px; margin-top:4px;" required></p>
            <button type="submit" style="width:100%; background:#007bff; color:white; border:none; padding:10px; border-radius:4px; cursor:pointer;">Masuk</button>
        </form>
        <p style="margin-top:15px; text-align:center;"><small>User: <b>budi</b> | Pass: <b>rahasia123!</b></small></p>
    </div>
</body>
</html>
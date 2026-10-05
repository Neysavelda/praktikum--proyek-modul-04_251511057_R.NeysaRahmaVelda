<?php
require 'koneksi.php';

$hash = password_hash('rahasia123', PASSWORD_DEFAULT);
$stmt = $pdo->prepare('INSERT INTO users (username, password, nama_lengkap) VALUES (?, ?, ?)');
$stmt->execute(['budi', $hash, 'Budi Santoso']);

echo 'User dibuat.';
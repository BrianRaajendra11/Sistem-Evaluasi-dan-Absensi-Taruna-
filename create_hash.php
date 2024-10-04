<?php
// Contoh password yang ingin di-hash
$password = 'password123'; 

// Menggunakan bcrypt untuk hashing password
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

echo $hashed_password; // Copy hasil ini untuk dimasukkan ke database
?>

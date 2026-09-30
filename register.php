<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include "config/koneksi.php";

if (isset($_POST['register'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];
    $password = md5($_POST['password']);

    $cek = mysqli_query($conn, "SELECT * FROM customer WHERE email='$email'");

    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('Email sudah terdaftar!');</script>";
    } else {
        mysqli_query($conn, "INSERT INTO customer(nama,email,no_hp,password,status_verifikasi)
        VALUES('$nama','$email','$no_hp','$password','belum')");

        echo "<script>alert('Register berhasil! Silakan login.'); window.location='login.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register Customer</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="form-box">
    <h2>Register Customer</h2>

    <form method="POST">
        <label>Nama</label>
        <input type="text" name="nama" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>No HP</label>
        <input type="text" name="no_hp" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button class="btn" type="submit" name="register">Register</button>
    </form>

    <br>
    <p>Sudah punya akun? <a href="login.php">Login</a></p>
</div>

</body>
</html>
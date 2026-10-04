<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include "config/koneksi.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Rental Mobil Platform</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="navbar">
    <div class="logo">RENTAL MOBIL</div>

    <div class="menu">
        <a href="index.php">Home</a>
        <a href="armada.php">Armada</a>

        <?php if(isset($_SESSION['customer'])) { ?>
            <a href="customer/dashboard.php">Dashboard</a>
            <a href="logout.php">Logout</a>
        <?php } else { ?>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        <?php } ?>
    </div>
</div>

<div class="hero">
    <h1>Sewa Mobil Lebih Mudah dan Cepat</h1>
    <p>
        Aplikasi rental mobil berbasis web ini digunakan untuk membantu customer
        melihat armada, melakukan pemesanan, membatalkan pesanan, melihat status
        pemesanan, serta melakukan pembayaran.
    </p>
    <a href="armada.php" class="btn">Lihat Armada</a>
</div>

<div class="container">
    <h2>Fitur Utama</h2>
    <br>

    <div class="card-wrapper">
        <div class="card">
            <h3>Login Customer</h3>
            <p>Customer dapat masuk ke sistem menggunakan akun yang sudah terdaftar.</p>
        </div>

        <div class="card">
            <h3>Pemesanan Mobil</h3>
            <p>Customer dapat memilih armada dan menentukan tanggal sewa.</p>
        </div>

        <div class="card">
            <h3>Status Pemesanan</h3>
            <p>Customer dapat melihat status pesanan seperti menunggu, diproses, selesai, atau dibatalkan.</p>
        </div>

        <div class="card">
            <h3>Pemesanan Mudah</h3>
            <p>Fitur Pemesanan yang mempermudah pengguna.</p>
        </div>
    </div>
</div>

</body>
</html>
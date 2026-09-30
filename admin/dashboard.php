<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include "../config/koneksi.php";

// Cek apakah admin sudah login
if (!isset($_SESSION['admin'])) {
    echo "<script>
            alert('Silakan login admin terlebih dahulu!');
            window.location='login.php';
          </script>";
    exit;
}

// Hitung total armada
$total_armada = mysqli_num_rows(
    mysqli_query($conn, "SELECT * FROM armada")
);

// Hitung total customer
$total_customer = mysqli_num_rows(
    mysqli_query($conn, "SELECT * FROM customer")
);

// Hitung total pemesanan
$total_pemesanan = mysqli_num_rows(
    mysqli_query($conn, "SELECT * FROM pemesanan")
);

// Hitung total pembayaran
$total_pembayaran = mysqli_num_rows(
    mysqli_query($conn, "SELECT * FROM pembayaran")
);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<!-- Navbar -->
<div class="navbar">
    <div class="logo">ADMIN PANEL</div>

    <div class="menu">
        <a href="dashboard.php">Dashboard</a>
        <a href="armada.php">Armada</a>
        <a href="pemesanan.php">Pemesanan</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<!-- Content -->
<div class="container">
    <h2>Selamat Datang, <?= $_SESSION['nama_admin']; ?></h2>
    <br>

    <div class="card-wrapper">

        <!-- Total Armada -->
        <div class="card">
            <h3>Total Armada</h3>
            <p><?= $total_armada; ?> mobil</p>
        </div>

        <!-- Total Customer -->
        <div class="card">
            <h3>Total Customer</h3>
            <p><?= $total_customer; ?> customer</p>
        </div>

        <!-- Total Pemesanan -->
        <div class="card">
            <h3>Total Pemesanan</h3>
            <p><?= $total_pemesanan; ?> pesanan</p>
        </div>

        <!-- Total Pembayaran -->
        <div class="card">
            <h3>Total Pembayaran</h3>
            <p><?= $total_pembayaran; ?> pembayaran</p>
        </div>

    </div>
</div>

</body>
</html>
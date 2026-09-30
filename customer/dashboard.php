<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include "../config/koneksi.php";

if (!isset($_SESSION['customer'])) {
    echo "<script>
            alert('Silakan login terlebih dahulu!');
            window.location='../login.php';
          </script>";
    exit;
}

$id_customer = $_SESSION['customer'];
$nama_customer = $_SESSION['nama_customer'];

$total_pesanan = mysqli_num_rows(
    mysqli_query($conn, "SELECT * FROM pemesanan WHERE id_customer='$id_customer'")
);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Customer</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<div class="navbar">
    <div class="logo">CUSTOMER</div>

    <div class="menu">
        <a href="../index.php">Home</a>
        <a href="../armada.php">Armada</a>
        <a href="status.php">Status Pesanan</a>
        <a href="../logout.php">Logout</a>
    </div>
</div>

<div class="container">
    <h2>Selamat Datang, <?= $nama_customer; ?></h2>
    <br>

    <div class="card-wrapper">
        <div class="card">
            <h3>Total Pesanan</h3>
            <p><?= $total_pesanan; ?> pesanan</p>
        </div>

        <div class="card">
            <h3>Pesan Armada</h3>
            <p>Pilih mobil yang tersedia dan lakukan pemesanan.</p>
            <br>
            <a href="../armada.php" class="btn">Lihat Armada</a>
        </div>

        <div class="card">
            <h3>Status Pemesanan</h3>
            <p>Lihat perkembangan pesanan kamu.</p>
            <br>
            <a href="status.php" class="btn">Lihat Status</a>
        </div>
    </div>
</div>

</body>
</html>
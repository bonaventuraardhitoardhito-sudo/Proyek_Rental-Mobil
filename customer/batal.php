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

if (!isset($_GET['id'])) {
    echo "<script>
            alert('ID pemesanan tidak ditemukan!');
            window.location='status.php';
          </script>";
    exit;
}

$id_pemesanan = $_GET['id'];

$get = mysqli_query($conn, "SELECT * FROM pemesanan WHERE id_pemesanan='$id_pemesanan'");
$data = mysqli_fetch_assoc($get);

if (!$data) {
    echo "<script>
            alert('Data pemesanan tidak ditemukan!');
            window.location='status.php';
          </script>";
    exit;
}

mysqli_query($conn, "UPDATE pemesanan SET status='dibatalkan' WHERE id_pemesanan='$id_pemesanan'");

mysqli_query($conn, "UPDATE armada SET status_ketersediaan='tersedia' WHERE id_armada='".$data['id_armada']."'");

echo "<script>
        alert('Pesanan berhasil dibatalkan!');
        window.location='status.php';
      </script>";
?>
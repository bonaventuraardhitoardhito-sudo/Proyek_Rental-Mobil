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

$id_pemesanan = $_GET['id'];

$q = mysqli_query($conn, "SELECT * FROM pemesanan WHERE id_pemesanan='$id_pemesanan'");
$p = mysqli_fetch_assoc($q);

if (!$p) {
    echo "<script>
            alert('Data pemesanan tidak ditemukan!');
            window.location='status.php';
          </script>";
    exit;
}

if (isset($_POST['bayar'])) {
    $metode = $_POST['metode'];
    $jumlah = $p['total'];

    $bukti = $_FILES['bukti_pembayaran']['name'];
    $tmp = $_FILES['bukti_pembayaran']['tmp_name'];

    $folder = "../bukti_pembayaran/";
    $nama_bukti_baru = time() . "_" . $bukti;

    move_uploaded_file($tmp, $folder . $nama_bukti_baru);

    mysqli_query($conn, "INSERT INTO pembayaran
        (id_pemesanan, metode, jumlah, status_pembayaran, bukti_pembayaran)
        VALUES
        ('$id_pemesanan', '$metode', '$jumlah', 'menunggu konfirmasi', '$nama_bukti_baru')
    ");

    mysqli_query($conn, "UPDATE pemesanan 
        SET status='diproses' 
        WHERE id_pemesanan='$id_pemesanan'
    ");

    echo "<script>
            alert('Pembayaran berhasil dikirim!');
            window.location='status.php';
          </script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pembayaran</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<div class="form-box">
    <h2>Pembayaran</h2>

    <form method="POST" enctype="multipart/form-data">
        <label>Total Bayar</label>
        <input type="text" value="Rp <?= number_format($p['total']); ?>" readonly>

        <label>Metode Pembayaran</label>
        <select name="metode" required>
            <option value="QRIS">QRIS</option>
            <option value="Transfer Bank">Transfer Bank</option>
            <option value="E-Wallet">E-Wallet</option>
        </select>

        <h3 style="text-align:center; margin-top:20px;">
            Scan QR Pembayaran
        </h3>

        <img src="../gambar/qris.png"
             width="250"
             style="display:block; margin:15px auto;">

        <p style="text-align:center;">
            Silakan scan QR di atas, lalu upload bukti pembayaran.
        </p>

        <label>Upload Bukti Pembayaran</label>
        <input type="file" name="bukti_pembayaran" accept="image/*" required>

        <button class="btn" type="submit" name="bayar">
            Kirim Pembayaran
        </button>

        <a href="status.php" class="btn">
            Close
        </a>
    </form>
</div>

</body>
</html>
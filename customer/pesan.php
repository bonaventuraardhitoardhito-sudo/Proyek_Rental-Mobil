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

$id_armada = $_GET['id'];
$id_customer = $_SESSION['customer'];
$tanggal_min = date('Y-m-d');
$tanggal_max = date('Y-m-d', strtotime('+1 month'));

mysqli_query($conn, "UPDATE armada
    SET status_ketersediaan = 'tersedia'
    WHERE stock > 0
");

mysqli_query($conn, "UPDATE armada
    SET status_ketersediaan = 'tidak tersedia'
    WHERE stock <= 0
");

$armada = mysqli_query($conn, "SELECT * FROM armada WHERE id_armada='$id_armada'");
$data = mysqli_fetch_assoc($armada);

if (!$data) {
    echo "<script>
            alert('Data armada tidak ditemukan!');
            window.location='../armada.php';
          </script>";
    exit;
}

if ($data['stock'] <= 0) {
    echo "<script>
            alert('Maaf, stock mobil habis!');
            window.location='../armada.php';
          </script>";
    exit;
}

$sopir = mysqli_query($conn, "SELECT * FROM sopir WHERE status='aktif'");

if (isset($_POST['pesan'])) {
    $tanggal_sewa = $_POST['tanggal_sewa'];
    $durasi = $_POST['durasi'];
    $id_sopir = $_POST['id_sopir'] == "" ? "NULL" : $_POST['id_sopir'];
    $total = $data['harga_sewa'] * $durasi;

    if ($data['stock'] <= 0) {
        echo "<script>
                alert('Maaf, stock mobil habis!');
                window.location='../armada.php';
              </script>";
        exit;
    }

    mysqli_query($conn, "INSERT INTO pemesanan(id_customer,id_armada,id_sopir,tanggal_sewa,durasi,total,status)
    VALUES('$id_customer','$id_armada',$id_sopir,'$tanggal_sewa','$durasi','$total','menunggu')");

    mysqli_query($conn, "UPDATE armada 
        SET stock = stock - 1
        WHERE id_armada='$id_armada'
    ");

    mysqli_query($conn, "UPDATE armada
        SET status_ketersediaan = 
            CASE 
                WHEN stock > 0 THEN 'tersedia'
                ELSE 'tidak tersedia'
            END
        WHERE id_armada='$id_armada'
    ");

    echo "<script>
            alert('Pemesanan berhasil dibuat!');
            window.location='status.php';
          </script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Pemesanan</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<div class="form-box">
    <h2>Form Pemesanan</h2>

    <form method="POST">
        <label>Mobil</label>
        <input type="text" value="<?= $data['nama_kendaraan']; ?>" readonly>

        <label>Harga per Hari</label>
        <input type="text" value="Rp <?= number_format($data['harga_sewa']); ?>" readonly>

        <label>Stock Tersedia</label>
        <input type="text" value="<?= $data['stock']; ?> unit" readonly>

        <input 
            type="date" 
            name="tanggal_sewa" 
            min="<?= $tanggal_min; ?>" 
            max="<?= $tanggal_max; ?>" 
            required
        >

        <label>Durasi Sewa / Hari</label>
        <input type="number" name="durasi" min="1" required>

        </select>

        <button class="btn" type="submit" name="pesan">
            Buat Pesanan
        </button>
    </form>
</div>

</body>
</html>
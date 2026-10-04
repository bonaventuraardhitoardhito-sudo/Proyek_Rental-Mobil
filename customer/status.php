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

$query = mysqli_query($conn, "SELECT pemesanan.*, armada.nama_kendaraan
FROM pemesanan
JOIN armada ON pemesanan.id_armada = armada.id_armada
WHERE pemesanan.id_customer='$id_customer'
ORDER BY pemesanan.id_pemesanan DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Status Pemesanan</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<div class="navbar">
    <div class="logo">CUSTOMER</div>

    <div class="menu">
        <a href="dashboard.php">Dashboard</a>
        <a href="../armada.php">Armada</a>
        <a href="../logout.php">Logout</a>
    </div>
</div>

<div class="container">
    <h2>Status Pemesanan</h2>

    <table>
        <tr>
            <th>No</th>
            <th>Mobil</th>
            <th>Tanggal</th>
            <th>Durasi</th>
            <th>Total</th>
            <th>Status Pembayaran</th>
            <th>Status Mobil</th>
            <th>Aksi</th>
        </tr>

        <?php $no = 1; while($row = mysqli_fetch_assoc($query)) { ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['nama_kendaraan']; ?></td>
            <td><?= $row['tanggal_sewa']; ?></td>
            <td><?= $row['durasi']; ?> hari</td>
            <td>Rp <?= number_format($row['total']); ?></td>

            <td>
                <span class="badge">
                    <?= $row['status']; ?>
                </span>
            </td>

            <td>
                <span class="badge">
                    <?= $row['status_mobil']; ?>
                </span>
            </td>

            <td>
                <?php if($row['status'] == 'menunggu') { ?>
                    <a class="btn" href="bayar.php?id=<?= $row['id_pemesanan']; ?>">Bayar</a>
                    <a class="btn" href="batal.php?id=<?= $row['id_pemesanan']; ?>" onclick="return confirm('Batalkan pesanan ini?')">Batal</a>
                <?php } else { ?>
                    -
                <?php } ?>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>
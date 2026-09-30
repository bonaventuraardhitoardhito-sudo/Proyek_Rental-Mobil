<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include "../config/koneksi.php";

if (!isset($_SESSION['admin'])) {
    echo "<script>
            alert('Silakan login admin terlebih dahulu!');
            window.location='login.php';
          </script>";
    exit;
}

if (isset($_GET['selesai'])) {
    $id = $_GET['selesai'];

    mysqli_query($conn, "UPDATE pemesanan
        SET status='selesai'
        WHERE id_pemesanan='$id'
    ");

    mysqli_query($conn, "UPDATE pembayaran
        SET status_pembayaran='lunas'
        WHERE id_pemesanan='$id'
    ");

    echo "<script>
            alert('Pembayaran berhasil dikonfirmasi!');
            window.location='pemesanan.php';
          </script>";
    exit;
}

if (isset($_GET['update_mobil']) && isset($_GET['id'])) {
    $id_pemesanan = $_GET['id'];
    $status_mobil = $_GET['update_mobil'];

    $get = mysqli_query($conn, "SELECT * FROM pemesanan WHERE id_pemesanan='$id_pemesanan'");
    $p = mysqli_fetch_assoc($get);

    if ($p) {
        mysqli_query($conn, "UPDATE pemesanan
            SET status_mobil='$status_mobil'
            WHERE id_pemesanan='$id_pemesanan'
        ");

        if ($status_mobil == 'sudah dikembalikan') {
            mysqli_query($conn, "UPDATE armada
                SET stock = stock + 1,
                    status_ketersediaan='tersedia'
                WHERE id_armada='".$p['id_armada']."'
            ");
        }

        echo "<script>
                alert('Status mobil berhasil diperbarui!');
                window.location='pemesanan.php';
              </script>";
        exit;
    }
}

$query = mysqli_query($conn,
    "SELECT pemesanan.*,
            customer.nama AS nama_customer,
            armada.nama_kendaraan
     FROM pemesanan
     JOIN customer
       ON pemesanan.id_customer = customer.id_customer
     JOIN armada
       ON pemesanan.id_armada = armada.id_armada
     ORDER BY pemesanan.id_pemesanan DESC"
);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Pemesanan</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<div class="navbar">
    <div class="logo">ADMIN PANEL</div>

    <div class="menu">
        <a href="dashboard.php">Dashboard</a>
        <a href="armada.php">Armada</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<div class="container">
    <h2>Data Pemesanan</h2>

    <table>
        <tr>
            <th>No</th>
            <th>Customer</th>
            <th>Mobil</th>
            <th>Tanggal</th>
            <th>Durasi</th>
            <th>Total</th>
            <th>Status Pembayaran</th>
            <th>Status Mobil</th>
            <th>Aksi Pembayaran</th>
            <th>Aksi Mobil</th>
        </tr>

        <?php $no = 1; while($row = mysqli_fetch_assoc($query)) { ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['nama_customer']; ?></td>
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
                <?php if ($row['status'] == 'diproses') { ?>
                    <a href="pemesanan.php?selesai=<?= $row['id_pemesanan']; ?>"
                       class="btn"
                       onclick="return confirm('Konfirmasi pembayaran sebagai lunas?')">
                        Terima Pembayaran
                    </a>
                <?php } else { ?>
                    -
                <?php } ?>
            </td>

            <td>
                <?php if ($row['status_mobil'] == 'belum diambil') { ?>

                    <a href="pemesanan.php?id=<?= $row['id_pemesanan']; ?>&update_mobil=sudah diambil"
                       class="btn"
                       onclick="return confirm('Ubah status mobil menjadi sudah diambil?')">
                        Sudah Diambil
                    </a>

                <?php } elseif ($row['status_mobil'] == 'sudah diambil') { ?>

                    <a href="pemesanan.php?id=<?= $row['id_pemesanan']; ?>&update_mobil=sedang digunakan"
                       class="btn"
                       onclick="return confirm('Ubah status mobil menjadi sedang digunakan?')">
                        Sedang Digunakan
                    </a>

                <?php } elseif ($row['status_mobil'] == 'sedang digunakan') { ?>

                    <a href="pemesanan.php?id=<?= $row['id_pemesanan']; ?>&update_mobil=sudah dikembalikan"
                       class="btn"
                       onclick="return confirm('Yakin mobil sudah dikembalikan?')">
                        Sudah Dikembalikan
                    </a>

                <?php } else { ?>
                    Selesai
                <?php } ?>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>
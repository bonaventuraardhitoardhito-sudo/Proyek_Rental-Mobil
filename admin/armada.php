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

if (isset($_POST['update_stock_status'])) {
    $id_armada = $_POST['id_armada'];
    $stock = $_POST['stock'];
    $status = $_POST['status_ketersediaan'];

    mysqli_query($conn, "UPDATE armada
        SET stock='$stock',
            status_ketersediaan='$status'
        WHERE id_armada='$id_armada'
    ");

    echo "<script>
            alert('Stock dan status berhasil diperbarui!');
            window.location='armada.php';
          </script>";
}

if (isset($_POST['tambah'])) {
    $nama = $_POST['nama_kendaraan'];
    $tipe = $_POST['tipe'];
    $harga = $_POST['harga_sewa'];
    $transmisi = $_POST['transmisi'];
    $stock = $_POST['stock'];

    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];

    $folder = "../gambar/";

    $nama_gambar_baru = $gambar;

    move_uploaded_file($tmp, $folder . $nama_gambar_baru);

    if ($stock > 0) {
        $status = "tersedia";
    } else {
        $status = "tidak tersedia";
    }

    mysqli_query($conn, "INSERT INTO armada
        (nama_kendaraan, tipe, harga_sewa, transmisi, status_ketersediaan, gambar, stock)
        VALUES
        ('$nama', '$tipe', '$harga', '$transmisi', '$status', '$nama_gambar_baru', '$stock')
    ");

    echo "<script>
            alert('Armada berhasil ditambahkan!');
            window.location='armada.php';
          </script>";
}

$data = mysqli_query($conn, "SELECT * FROM armada ORDER BY id_armada DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kelola Armada</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<div class="navbar">
    <div class="logo">ADMIN PANEL</div>

    <div class="menu">
        <a href="dashboard.php">Dashboard</a>
        <a href="pemesanan.php">Pemesanan</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<div class="container">
    <h2>Tambah Armada</h2>

    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="nama_kendaraan" placeholder="Nama kendaraan" required>
        <input type="text" name="tipe" placeholder="Tipe kendaraan" required>
        <input type="number" name="harga_sewa" placeholder="Harga sewa per hari" required>

        <select name="transmisi" required>
            <option value="Manual">Manual</option>
            <option value="Matic">Matic</option>
        </select>

        <input type="number" name="stock" placeholder="Jumlah stock mobil" min="0" required>

        <input type="file" name="gambar" accept="image/*" required>

        <button type="submit" name="tambah" class="btn">Tambah</button>
    </form>

    <h2 style="margin-top:30px;">Data Armada</h2>

    <table>
        <tr>
            <th>No</th>
            <th>Gambar</th>
            <th>Nama</th>
            <th>Tipe</th>
            <th>Harga</th>
            <th>Transmisi</th>
            <th>Stock</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

        <?php $no = 1; while($row = mysqli_fetch_assoc($data)) { ?>
        <tr>
            <td><?= $no++; ?></td>

            <td>
                <?php if (!empty($row['gambar'])) { ?>
                    <img src="../gambar/<?= $row['gambar']; ?>" width="120">
                <?php } else { ?>
                    Tidak ada gambar
                <?php } ?>
            </td>

            <td><?= $row['nama_kendaraan']; ?></td>
            <td><?= $row['tipe']; ?></td>
            <td>Rp <?= number_format($row['harga_sewa']); ?></td>
            <td><?= $row['transmisi']; ?></td>
            <td><?= $row['stock']; ?> unit</td>
            <td><?= $row['status_ketersediaan']; ?></td>
            <td>
                <form method="POST" style="display:flex; gap:5px;">
                    <input type="hidden" name="id_armada" value="<?= $row['id_armada']; ?>">

                    <input type="number" name="stock" value="<?= $row['stock']; ?>" min="0" style="width:70px;">

                    <select name="status_ketersediaan">
                        <option value="tersedia" <?= $row['status_ketersediaan'] == 'tersedia' ? 'selected' : ''; ?>>
                            tersedia
                        </option>
                        <option value="tidak tersedia" <?= $row['status_ketersediaan'] == 'tidak tersedia' ? 'selected' : ''; ?>>
                            tidak tersedia
                        </option>
                    </select>

                    <button type="submit" name="update_stock_status" class="btn">
                        Update
                    </button>
                </form>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>
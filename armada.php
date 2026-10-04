<?php
session_start();
include "config/koneksi.php";

mysqli_query($conn, "UPDATE armada
    SET status_ketersediaan = 'tersedia'
    WHERE stock > 0
");

mysqli_query($conn, "UPDATE armada
    SET status_ketersediaan = 'tidak tersedia'
    WHERE stock <= 0
");

$query = mysqli_query($conn, "SELECT * FROM armada ORDER BY id_armada ASC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Armada</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Navbar -->
<div class="navbar">
    <div class="logo">RENTAL MOBIL</div>

    <div class="menu">
        <a href="index.php">Home</a>
        <a href="armada.php">Armada</a>

        <?php if (isset($_SESSION['customer'])) { ?>
            <a href="customer/dashboard.php">Dashboard</a>
            <a href="logout.php">Logout</a>
        <?php } else { ?>
            <a href="login.php">Login</a>
        <?php } ?>
    </div>
</div>

<!-- Konten -->
<div class="container">
    <h2>Daftar Armada</h2>

    <div class="card-wrapper">

        <?php while ($row = mysqli_fetch_assoc($query)) { ?>

            <?php
            // Ambil nama gambar dari database
            // Jika kolom gambar kosong, gunakan default.png
            if (!empty($row['gambar'])) {
                $gambar = $row['gambar'];
            } else {
                $gambar = "default.png";
            }
            ?>

            <div class="card">

                <!-- Gambar mobil dari database -->
                <img src="gambar/<?= $gambar; ?>" class="car-image">

                <!-- Nama mobil -->
                <h3><?= $row['nama_kendaraan']; ?></h3>

                <!-- Informasi mobil -->
                <p>Tipe: <?= $row['tipe']; ?></p>
                <p>Transmisi: <?= $row['transmisi']; ?></p>
                <p>Harga: Rp <?= number_format($row['harga_sewa']); ?> / hari</p>

                <p>
                    Status:
                    <span class="badge">
                        <?= $row['status_ketersediaan']; ?>
                    </span>
                </p>

                <!-- Tombol pesan -->
                <?php if ($row['status_ketersediaan'] == 'tersedia') { ?>

                   <?php if (isset($_SESSION['customer'])) { ?>
                        <a href="customer/pesan.php?id=<?= $row['id_armada']; ?>" class="btn">
                            Pesan
                        </a>
                    <?php } else { ?>
                        <a href="login.php" class="btn">
                            Login untuk Pesan
                        </a>
                    <?php } ?>

                <?php } else { ?>
                    <button class="btn" disabled>
                        Tidak Tersedia
                    </button>
                <?php } ?>

            </div>

        <?php } ?>

    </div>
</div>

</body>
</html>
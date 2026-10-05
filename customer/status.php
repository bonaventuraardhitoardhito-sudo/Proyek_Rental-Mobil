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
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Status Pemesanan - Rental Mobil</title>


    <style>

        /* =========================================
           RESET
        ========================================= */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        html {
            scroll-behavior: smooth;
        }


        /* =========================================
           BODY
        ========================================= */

        body {

            font-family: Arial, Helvetica, sans-serif;

            min-height: 100vh;

            color: #222;

            background: linear-gradient(
                120deg,
                #383232,
                #3e3b3b,
                #0b080b,
                #4f4c4c
            );

            background-size: 400% 400%;

            animation: backgroundMove 12s ease infinite;

        }


        @keyframes backgroundMove {

            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }

        }


        /* =========================================
           NAVBAR
        ========================================= */

        .navbar {

            width: 100%;

            height: 72px;

            padding: 0 6%;

            display: flex;

            align-items: center;

            justify-content: space-between;

            background: rgba(15, 13, 16, 0.78);

            backdrop-filter: blur(15px);

            -webkit-backdrop-filter: blur(15px);

            border-bottom: 1px solid rgba(255,255,255,0.10);

            position: sticky;

            top: 0;

            z-index: 1000;

        }


        .logo {

            color: white;

            font-size: 20px;

            font-weight: bold;

            letter-spacing: 1.5px;

        }


        .logo span {

            color: #aaa6b5;

        }


        .menu {

            display: flex;

            align-items: center;

            gap: 8px;

        }


        .menu a {

            color: #d7d5d8;

            text-decoration: none;

            font-size: 13px;

            padding: 10px 13px;

            border-radius: 9px;

            transition: 0.3s ease;

        }


        .menu a:hover {

            color: white;

            background: rgba(255,255,255,0.08);

        }


        .menu .active {

            color: white;

            background: rgba(255,255,255,0.10);

        }


        .logout {

            border: 1px solid rgba(255,255,255,0.15);

        }


        /* =========================================
           CONTAINER
        ========================================= */

        .container {

            width: 88%;

            max-width: 1200px;

            margin: 0 auto;

            padding: 50px 0 70px;

        }


        /* =========================================
           PAGE HEADER
        ========================================= */

        .page-header {

            text-align: center;

            color: white;

            margin-bottom: 35px;

        }


        .page-header .small-title {

            font-size: 12px;

            color: #aaa7ae;

            letter-spacing: 1.5px;

            margin-bottom: 8px;

        }


        .page-header h1 {

            font-size: 32px;

            margin-bottom: 10px;

        }


        .page-header p {

            color: #c0bdc3;

            font-size: 14px;

            line-height: 1.6;

        }


        /* =========================================
           ORDER WRAPPER
        ========================================= */

        .order-list {

            display: grid;

            grid-template-columns: 1fr;

            gap: 20px;

        }


        /* =========================================
           ORDER CARD
        ========================================= */

        .order-card {

            background: rgba(255,255,255,0.97);

            border-radius: 20px;

            padding: 25px;

            box-shadow:
                0 15px 35px rgba(0,0,0,0.20);

            position: relative;

            overflow: hidden;

            transition: 0.3s ease;

        }


        .order-card::before {

            content: "";

            position: absolute;

            top: 0;

            left: 0;

            width: 100%;

            height: 4px;

            background: linear-gradient(
                90deg,
                #e0e0e6,
                #5b4de8,
                #47454c
            );

        }


        .order-card:hover {

            transform: translateY(-4px);

            box-shadow:
                0 20px 42px rgba(0,0,0,0.25);

        }


        /* =========================================
           ORDER TOP
        ========================================= */

        .order-top {

            display: flex;

            justify-content: space-between;

            align-items: center;

            gap: 20px;

            padding-bottom: 20px;

            border-bottom: 1px solid #ecebed;

        }


        .vehicle {

            display: flex;

            align-items: center;

            gap: 15px;

        }


        .vehicle-icon {

            width: 52px;

            height: 52px;

            border-radius: 14px;

            background: linear-gradient(
                135deg,
                #f0eff2,
                #dedce1
            );

            display: flex;

            justify-content: center;

            align-items: center;

            font-size: 23px;

            color: #47434d;

        }


        .vehicle-info h2 {

            color: #29272d;

            font-size: 18px;

            margin-bottom: 5px;

        }


        .vehicle-info p {

            color: #929097;

            font-size: 12px;

        }


        .order-number {

            color: #99969d;

            font-size: 11px;

            text-align: right;

        }


        /* =========================================
           DETAIL GRID
        ========================================= */

        .detail-grid {

            display: grid;

            grid-template-columns:
                repeat(4, 1fr);

            gap: 14px;

            margin-top: 20px;

        }


        .detail-box {

            background: #f7f6f8;

            border: 1px solid #ecebed;

            border-radius: 12px;

            padding: 14px;

        }


        .detail-label {

            font-size: 10px;

            color: #99969d;

            text-transform: uppercase;

            letter-spacing: 0.5px;

            margin-bottom: 6px;

        }


        .detail-value {

            color: #38353d;

            font-size: 13px;

            font-weight: bold;

        }


        .price {

            color: #403a4b;

            font-size: 14px;

        }


        /* =========================================
           STATUS SECTION
        ========================================= */

        .status-section {

            display: flex;

            align-items: center;

            gap: 12px;

            margin-top: 20px;

            flex-wrap: wrap;

        }


        .status-title {

            color: #77747b;

            font-size: 12px;

            margin-right: 2px;

        }


        .badge {

            display: inline-flex;

            align-items: center;

            gap: 6px;

            padding: 7px 12px;

            border-radius: 20px;

            font-size: 11px;

            font-weight: bold;

            background: #efedf1;

            color: #4c4852;

        }


        .badge::before {

            content: "";

            width: 6px;

            height: 6px;

            border-radius: 50%;

            background: #777;

        }


        /* Status menunggu */

        .badge.menunggu {

            background: #fff4df;

            color: #93620c;

        }


        .badge.menunggu::before {

            background: #d89b22;

        }


        /* Status berhasil */

        .badge.dibayar,
        .badge.disetujui,
        .badge.selesai {

            background: #e6f7ec;

            color: #24753f;

        }


        .badge.dibayar::before,
        .badge.disetujui::before,
        .badge.selesai::before {

            background: #2c9b51;

        }


        /* Status batal */

        .badge.dibatalkan,
        .badge.ditolak {

            background: #fbe7e8;

            color: #a33b42;

        }


        .badge.dibatalkan::before,
        .badge.ditolak::before {

            background: #c34d55;

        }


        /* =========================================
           ACTION AREA
        ========================================= */

        .order-bottom {

            display: flex;

            justify-content: space-between;

            align-items: center;

            gap: 20px;

            margin-top: 22px;

            padding-top: 20px;

            border-top: 1px solid #ecebed;

        }


        .status-info {

            color: #8b888e;

            font-size: 11px;

            line-height: 1.5;

        }


        .actions {

            display: flex;

            gap: 9px;

        }


        .btn {

            display: inline-block;

            text-decoration: none;

            border: none;

            cursor: pointer;

            padding: 10px 16px;

            border-radius: 9px;

            font-size: 11px;

            font-weight: bold;

            transition: 0.3s;

        }


        .btn:hover {

            transform: translateY(-2px);

        }


        .btn-bayar {

            color: white;

            background: linear-gradient(
                135deg,
                #e0e0e6,
                #47454c
            );

            box-shadow:
                0 5px 12px rgba(0,0,0,0.12);

        }


        .btn-bayar:hover {

            box-shadow:
                0 8px 17px rgba(0,0,0,0.20);

        }


        .btn-batal {

            color: #9b444b;

            background: #f9e9ea;

            border: 1px solid #f0d2d4;

        }


        .btn-batal:hover {

            background: #f5dfe1;

        }


        .no-action {

            color: #aaa7ad;

            font-size: 12px;

        }


        /* =========================================
           EMPTY STATE
        ========================================= */

        .empty-state {

            background: rgba(255,255,255,0.96);

            border-radius: 20px;

            padding: 55px 30px;

            text-align: center;

            box-shadow:
                0 15px 35px rgba(0,0,0,0.20);

        }


        .empty-icon {

            width: 70px;

            height: 70px;

            margin: 0 auto 18px;

            border-radius: 20px;

            display: flex;

            align-items: center;

            justify-content: center;

            background: #f0eff2;

            font-size: 30px;

        }


        .empty-state h2 {

            color: #302d35;

            font-size: 20px;

            margin-bottom: 8px;

        }


        .empty-state p {

            color: #88858c;

            font-size: 13px;

            margin-bottom: 22px;

        }


        .empty-state .btn {

            color: white;

            background: linear-gradient(
                135deg,
                #e0e0e6,
                #47454c
            );

            padding: 12px 20px;

        }


        /* =========================================
           FOOTER
        ========================================= */

        .footer {

            text-align: center;

            color: #aaa7ad;

            font-size: 11px;

            margin-top: 35px;

        }


        /* =========================================
           RESPONSIVE
        ========================================= */

        @media (max-width: 900px) {

            .detail-grid {

                grid-template-columns:
                    repeat(2, 1fr);

            }

        }


        @media (max-width: 700px) {

            .navbar {

                height: auto;

                padding: 16px 5%;

                align-items: flex-start;

                flex-direction: column;

                gap: 12px;

            }


            .menu {

                width: 100%;

                overflow-x: auto;

                gap: 3px;

                padding-bottom: 3px;

            }


            .menu a {

                white-space: nowrap;

                font-size: 12px;

                padding: 8px 10px;

            }


            .container {

                width: 92%;

                padding-top: 35px;

            }


            .page-header {

                text-align: left;

            }


            .page-header h1 {

                font-size: 27px;

            }


            .order-top {

                align-items: flex-start;

                flex-direction: column;

            }


            .order-number {

                text-align: left;

            }


            .detail-grid {

                grid-template-columns: 1fr 1fr;

            }


            .order-bottom {

                align-items: flex-start;

                flex-direction: column;

            }


            .actions {

                width: 100%;

            }


            .actions .btn {

                flex: 1;

                text-align: center;

            }

        }


        @media (max-width: 480px) {

            .order-card {

                padding: 20px;

            }


            .detail-grid {

                grid-template-columns: 1fr;

            }


            .vehicle-info h2 {

                font-size: 16px;

            }


            .status-section {

                align-items: flex-start;

                flex-direction: column;

            }


            .actions {

                flex-direction: column;

            }


            .actions .btn {

                width: 100%;

            }

        }

    </style>

</head>


<body>


<!-- =========================================
     NAVBAR
========================================= -->

<div class="navbar">

    <div class="logo">
        RENTAL <span>MOBIL</span>
    </div>


    <div class="menu">

        <a href="dashboard.php">
            Dashboard
        </a>

        <a href="../armada.php">
            Armada
        </a>

        <a
            href="status.php"
            class="active"
        >
            Status Pesanan
        </a>

        <a href="akun.php">
            Akun Saya
        </a>

        <a
            href="../logout.php"
            class="logout"
        >
            Logout
        </a>

    </div>

</div>



<!-- =========================================
     CONTENT
========================================= -->

<div class="container">


    <!-- PAGE HEADER -->

    <div class="page-header">

        <div class="small-title">
            CUSTOMER AREA
        </div>

        <h1>
            Status Pemesanan
        </h1>

        <p>
            Pantau seluruh pemesanan kendaraan yang
            pernah kamu lakukan.
        </p>

    </div>



    <!-- ORDER LIST -->

    <div class="order-list">

        <?php

        $no = 1;

        if (mysqli_num_rows($query) > 0) {

            while ($row = mysqli_fetch_assoc($query)) {

                /*
                 * Ubah status menjadi class CSS
                 * agar tampilan badge menyesuaikan status.
                 */

                $status_class = strtolower(
                    str_replace(
                        ' ',
                        '-',
                        $row['status']
                    )
                );


                $status_mobil_class = strtolower(
                    str_replace(
                        ' ',
                        '-',
                        $row['status_mobil']
                    )
                );

        ?>


        <!-- =====================================
             ORDER CARD
        ====================================== -->

        <div class="order-card">


            <!-- TOP -->

            <div class="order-top">


                <div class="vehicle">

                    <div class="vehicle-icon">
                        🚗
                    </div>


                    <div class="vehicle-info">

                        <h2>
                            <?= htmlspecialchars(
                                $row['nama_kendaraan']
                            ); ?>
                        </h2>

                        <p>
                            Pesanan #<?= $row['id_pemesanan']; ?>
                        </p>

                    </div>

                </div>


                <div class="order-number">

                    Pesanan ke-<?= $no++; ?>

                </div>

            </div>



            <!-- DETAIL -->

            <div class="detail-grid">


                <!-- TANGGAL -->

                <div class="detail-box">

                    <div class="detail-label">
                        Tanggal Sewa
                    </div>

                    <div class="detail-value">

                        <?= htmlspecialchars(
                            $row['tanggal_sewa']
                        ); ?>

                    </div>

                </div>


                <!-- DURASI -->

                <div class="detail-box">

                    <div class="detail-label">
                        Durasi
                    </div>

                    <div class="detail-value">

                        <?= htmlspecialchars(
                            $row['durasi']
                        ); ?>

                        hari

                    </div>

                </div>


                <!-- TOTAL -->

                <div class="detail-box">

                    <div class="detail-label">
                        Total
                    </div>

                    <div class="detail-value price">

                        Rp <?= number_format(
                            $row['total']
                        ); ?>

                    </div>

                </div>


                <!-- STATUS PEMBAYARAN -->

                <div class="detail-box">

                    <div class="detail-label">
                        Pembayaran
                    </div>

                    <div class="detail-value">

                        <span
                            class="badge <?= $status_class; ?>"
                        >

                            <?= htmlspecialchars(
                                $row['status']
                            ); ?>

                        </span>

                    </div>

                </div>

            </div>



            <!-- STATUS MOBIL -->

            <div class="status-section">

                <span class="status-title">
                    Status Mobil:
                </span>

                <span
                    class="badge <?= $status_mobil_class; ?>"
                >

                    <?= htmlspecialchars(
                        $row['status_mobil']
                    ); ?>

                </span>

            </div>



            <!-- BOTTOM -->

            <div class="order-bottom">


                <div class="status-info">

                    Pantau status pesanan kamu
                    sebelum menggunakan kendaraan.

                </div>


                <div class="actions">


                    <?php if ($row['status'] == 'menunggu') { ?>


                        <a
                            class="btn btn-bayar"
                            href="bayar.php?id=<?= $row['id_pemesanan']; ?>"
                        >
                            💳 Bayar
                        </a>


                        <a
                            class="btn btn-batal"
                            href="batal.php?id=<?= $row['id_pemesanan']; ?>"
                            onclick="return confirm('Batalkan pesanan ini?')"
                        >
                            Batalkan
                        </a>


                    <?php } else { ?>


                        <span class="no-action">
                            Tidak ada aksi tersedia
                        </span>


                    <?php } ?>


                </div>

            </div>


        </div>


        <?php

            }

        } else {

        ?>


        <!-- =====================================
             BELUM ADA PESANAN
        ====================================== -->

        <div class="empty-state">

            <div class="empty-icon">
                🚗
            </div>


            <h2>
                Belum Ada Pesanan
            </h2>


            <p>
                Kamu belum memiliki pemesanan kendaraan.
                Yuk lihat armada yang tersedia.
            </p>


            <a
                href="../armada.php"
                class="btn"
            >
                Lihat Armada
            </a>

        </div>


        <?php

        }

        ?>

    </div>



    <!-- FOOTER -->

    <div class="footer">

        © <?= date('Y'); ?> Rental Mobil.
        Semua hak dilindungi.

    </div>


</div>


</body>

</html>
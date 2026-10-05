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
    mysqli_query(
        $conn,
        "SELECT * FROM pemesanan WHERE id_customer='$id_customer'"
    )
);
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Dashboard Customer - Rental Mobil</title>


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
           MAIN
        ========================================= */

        .container {

            width: 88%;

            max-width: 1200px;

            margin: 0 auto;

            padding: 55px 0 70px;

        }


        /* =========================================
           WELCOME SECTION
        ========================================= */

        .welcome {

            position: relative;

            overflow: hidden;

            background: linear-gradient(
                135deg,
                rgba(67,64,67,0.95),
                rgba(63,61,67,0.92),
                rgba(13,4,18,0.96),
                rgba(50,50,54,0.94)
            );

            background-size: 300% 300%;

            animation: purpleMove 10s ease infinite;

            border-radius: 24px;

            padding: 38px 42px;

            color: white;

            box-shadow:
                0 20px 50px rgba(0,0,0,0.30);

            margin-bottom: 30px;

        }


        @keyframes purpleMove {

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


        .welcome::before {

            content: "";

            position: absolute;

            width: 230px;

            height: 230px;

            border: 1px solid rgba(255,255,255,0.08);

            border-radius: 50%;

            right: -70px;

            top: -100px;

        }


        .welcome::after {

            content: "";

            position: absolute;

            width: 150px;

            height: 150px;

            border: 1px solid rgba(255,255,255,0.06);

            border-radius: 50%;

            right: 70px;

            bottom: -100px;

        }


        .welcome-content {

            position: relative;

            z-index: 2;

        }


        .welcome-small {

            color: #bbb8c2;

            font-size: 13px;

            margin-bottom: 9px;

            letter-spacing: 0.5px;

        }


        .welcome h1 {

            font-size: 32px;

            line-height: 1.2;

            margin-bottom: 10px;

        }


        .welcome h1 span {

            color: #d8d5df;

        }


        .welcome p {

            color: #c9c7cc;

            font-size: 14px;

            line-height: 1.7;

            max-width: 650px;

        }


        .welcome-actions {

            margin-top: 24px;

            display: flex;

            gap: 12px;

            flex-wrap: wrap;

        }


        .welcome-btn {

            display: inline-block;

            text-decoration: none;

            padding: 12px 19px;

            border-radius: 10px;

            font-size: 13px;

            font-weight: bold;

            transition: 0.3s;

        }


        .welcome-btn.primary {

            color: #29272d;

            background: #f0eff2;

        }


        .welcome-btn.secondary {

            color: white;

            border: 1px solid rgba(255,255,255,0.18);

            background: rgba(255,255,255,0.06);

        }


        .welcome-btn:hover {

            transform: translateY(-2px);

            box-shadow:
                0 8px 18px rgba(0,0,0,0.18);

        }


        /* =========================================
           SECTION TITLE
        ========================================= */

        .section-heading {

            display: flex;

            justify-content: space-between;

            align-items: end;

            margin: 38px 0 18px;

        }


        .section-heading h2 {

            color: white;

            font-size: 20px;

        }


        .section-heading p {

            color: #aaa7ad;

            font-size: 12px;

        }


        /* =========================================
           STAT CARDS
        ========================================= */

        .stats {

            display: grid;

            grid-template-columns: repeat(3, 1fr);

            gap: 20px;

        }


        .stat-card {

            background: rgba(255,255,255,0.96);

            border-radius: 18px;

            padding: 23px;

            box-shadow:
                0 15px 35px rgba(0,0,0,0.20);

            transition: 0.3s ease;

            position: relative;

            overflow: hidden;

        }


        .stat-card::before {

            content: "";

            position: absolute;

            top: 0;

            left: 0;

            width: 100%;

            height: 4px;

            background: linear-gradient(
                90deg,
                #dedde2,
                #625c68,
                #302c34
            );

        }


        .stat-card:hover {

            transform: translateY(-5px);

            box-shadow:
                0 20px 40px rgba(0,0,0,0.25);

        }


        .stat-icon {

            width: 43px;

            height: 43px;

            border-radius: 12px;

            display: flex;

            justify-content: center;

            align-items: center;

            background: #f0eff1;

            color: #45414a;

            font-size: 19px;

            margin-bottom: 15px;

        }


        .stat-card h3 {

            font-size: 13px;

            color: #77747a;

            margin-bottom: 7px;

            font-weight: normal;

        }


        .stat-number {

            font-size: 27px;

            font-weight: bold;

            color: #29272d;

        }


        .stat-desc {

            font-size: 11px;

            color: #99969c;

            margin-top: 5px;

        }


        /* =========================================
           MENU CARDS
        ========================================= */

        .card-wrapper {

            display: grid;

            grid-template-columns: repeat(3, 1fr);

            gap: 20px;

        }


        .card {

            background: rgba(255,255,255,0.97);

            border-radius: 19px;

            padding: 25px;

            min-height: 220px;

            box-shadow:
                0 15px 35px rgba(0,0,0,0.20);

            transition: 0.3s ease;

            position: relative;

            overflow: hidden;

            display: flex;

            flex-direction: column;

        }


        .card::before {

            content: "";

            position: absolute;

            top: 0;

            left: 0;

            height: 4px;

            width: 100%;

            background: linear-gradient(
                90deg,
                #e0e0e6,
                #5b4de8,
                #47454c
            );

        }


        .card:hover {

            transform: translateY(-5px);

            box-shadow:
                0 20px 40px rgba(0,0,0,0.25);

        }


        .card-icon {

            width: 45px;

            height: 45px;

            border-radius: 13px;

            display: flex;

            justify-content: center;

            align-items: center;

            background: #f1f0f2;

            color: #4a4650;

            font-size: 20px;

            margin-bottom: 17px;

        }


        .card h3 {

            color: #29272d;

            font-size: 17px;

            margin-bottom: 9px;

        }


        .card p {

            color: #77747a;

            font-size: 13px;

            line-height: 1.7;

            flex: 1;

        }


        .btn {

            display: inline-block;

            width: 100%;

            padding: 12px 15px;

            text-align: center;

            text-decoration: none;

            border-radius: 10px;

            font-size: 12px;

            font-weight: bold;

            color: white;

            background: linear-gradient(
                135deg,
                #e0e0e6,
                #47454c
            );

            transition: 0.3s;

            margin-top: 18px;

        }


        .btn:hover {

            transform: translateY(-2px);

            box-shadow:
                0 7px 15px rgba(0,0,0,0.18);

        }


        /* =========================================
           QUICK INFO
        ========================================= */

        .quick-info {

            margin-top: 30px;

            background: rgba(255,255,255,0.94);

            border-radius: 18px;

            padding: 25px 28px;

            box-shadow:
                0 15px 35px rgba(0,0,0,0.18);

        }


        .quick-info h3 {

            font-size: 17px;

            color: #29272d;

            margin-bottom: 18px;

        }


        .info-items {

            display: grid;

            grid-template-columns: repeat(3, 1fr);

            gap: 15px;

        }


        .info-item {

            padding: 15px;

            background: #f6f5f7;

            border-radius: 12px;

        }


        .info-item strong {

            display: block;

            color: #403c45;

            font-size: 13px;

            margin-bottom: 5px;

        }


        .info-item span {

            color: #88858b;

            font-size: 12px;

            line-height: 1.5;

        }


        /* =========================================
           FOOTER
        ========================================= */

        .footer {

            text-align: center;

            padding-top: 35px;

            color: #a9a6ab;

            font-size: 11px;

        }


        /* =========================================
           RESPONSIVE
        ========================================= */

        @media (max-width: 900px) {

            .stats {

                grid-template-columns: 1fr;

            }

            .card-wrapper {

                grid-template-columns: repeat(2, 1fr);

            }

            .info-items {

                grid-template-columns: 1fr;

            }

            .menu {

                gap: 2px;

            }

            .menu a {

                padding: 8px;

            }

        }


        @media (max-width: 650px) {

            .navbar {

                height: auto;

                padding: 16px 5%;

                align-items: flex-start;

                gap: 12px;

                flex-direction: column;

            }

            .menu {

                width: 100%;

                overflow-x: auto;

                padding-bottom: 3px;

            }

            .menu a {

                white-space: nowrap;

            }

            .container {

                width: 92%;

                padding-top: 30px;

            }

            .welcome {

                padding: 28px 25px;

            }

            .welcome h1 {

                font-size: 25px;

            }

            .card-wrapper {

                grid-template-columns: 1fr;

            }

            .section-heading {

                align-items: flex-start;

                flex-direction: column;

                gap: 5px;

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

        <a href="../index.php">
            Home
        </a>

        <a href="../armada.php">
            Armada
        </a>

        <a href="status.php">
            Status Pesanan
        </a>

        <a
            href="akun.php"
            class="active"
        >
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
     MAIN CONTENT
========================================= -->

<div class="container">


    <!-- =====================================
         WELCOME
    ====================================== -->

    <section class="welcome">

        <div class="welcome-content">

            <div class="welcome-small">
                DASHBOARD CUSTOMER
            </div>


            <h1>
                Selamat Datang,
                <span>
                    <?= htmlspecialchars($nama_customer); ?>
                </span>
            </h1>


            <p>
                Kelola pemesanan kendaraan, lihat status pesanan,
                dan atur informasi akun kamu dengan mudah melalui
                dashboard ini.
            </p>


            <div class="welcome-actions">

                <a
                    href="../armada.php"
                    class="welcome-btn primary"
                >
                    Lihat Armada
                </a>


                <a
                    href="akun.php"
                    class="welcome-btn secondary"
                >
                    Kelola Akun
                </a>

            </div>

        </div>

    </section>



    <!-- =====================================
         STATISTIK
    ====================================== -->

    <div class="section-heading">

        <div>

            <h2>
                Ringkasan Akun
            </h2>

        </div>

        <p>
            Informasi akun kamu
        </p>

    </div>


    <div class="stats">


        <!-- TOTAL PESANAN -->

        <div class="stat-card">

            <div class="stat-icon">
                🚗
            </div>

            <h3>
                Total Pesanan
            </h3>

            <div class="stat-number">
                <?= $total_pesanan; ?>
            </div>

            <div class="stat-desc">
                Pesanan yang pernah dibuat
            </div>

        </div>


        <!-- STATUS -->

        <div class="stat-card">

            <div class="stat-icon">
                📋
            </div>

            <h3>
                Status Pesanan
            </h3>

            <div class="stat-number">
                Cek
            </div>

            <div class="stat-desc">
                Lihat perkembangan pemesanan
            </div>

        </div>


        <!-- AKUN -->

        <div class="stat-card">

            <div class="stat-icon">
                👤
            </div>

            <h3>
                Profil Customer
            </h3>

            <div class="stat-number">
                Aktif
            </div>

            <div class="stat-desc">
                Kelola data akun kamu
            </div>

        </div>


    </div>



    <!-- =====================================
         MENU UTAMA
    ====================================== -->

    <div class="section-heading">

        <div>

            <h2>
                Menu Utama
            </h2>

        </div>

        <p>
            Pilih layanan yang ingin kamu gunakan
        </p>

    </div>


    <div class="card-wrapper">


        <!-- PESAN ARMADA -->

        <div class="card">

            <div class="card-icon">
                🚘
            </div>

            <h3>
                Pesan Armada
            </h3>

            <p>
                Pilih kendaraan yang tersedia dan
                lakukan pemesanan sesuai kebutuhanmu.
            </p>

            <a
                href="../armada.php"
                class="btn"
            >
                Lihat Armada
            </a>

        </div>


        <!-- STATUS PESANAN -->

        <div class="card">

            <div class="card-icon">
                📋
            </div>

            <h3>
                Status Pesanan
            </h3>

            <p>
                Lihat perkembangan dan status
                pemesanan kendaraan yang sudah kamu lakukan.
            </p>

            <a
                href="status.php"
                class="btn"
            >
                Lihat Status
            </a>

        </div>


        <!-- AKUN -->

        <div class="card">

            <div class="card-icon">
                👤
            </div>

            <h3>
                Akun Saya
            </h3>

            <p>
                Kelola nama, nomor HP, alamat,
                dan password akun kamu.
            </p>

            <a
                href="akun.php"
                class="btn"
            >
                Kelola Akun
            </a>

        </div>


    </div>



    <!-- =====================================
         INFORMASI
    ====================================== -->

    <div class="quick-info">

        <h3>
            Informasi Rental
        </h3>


        <div class="info-items">


            <div class="info-item">

                <strong>
                    🚗 Pilih Kendaraan
                </strong>

                <span>
                    Lihat armada yang tersedia
                    sebelum melakukan pemesanan.
                </span>

            </div>


            <div class="info-item">

                <strong>
                    📋 Pantau Pesanan
                </strong>

                <span>
                    Periksa status pemesanan
                    melalui menu Status Pesanan.
                </span>

            </div>


            <div class="info-item">

                <strong>
                    👤 Lengkapi Profil
                </strong>

                <span>
                    Pastikan nomor HP dan alamat
                    sudah sesuai untuk kebutuhan rental.
                </span>

            </div>


        </div>

    </div>



    <!-- =====================================
         FOOTER
    ====================================== -->

    <div class="footer">

        © <?= date('Y'); ?> Rental Mobil.
        Semua hak dilindungi.

    </div>


</div>


</body>

</html>
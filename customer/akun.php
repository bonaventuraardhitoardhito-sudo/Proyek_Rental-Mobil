<?php
session_start();
include "../config/koneksi.php";

/* =========================================
   CEK LOGIN
========================================= */
if (!isset($_SESSION['customer'])) {
    header("Location: ../login.php");
    exit;
}

/* =========================================
   AMBIL DATA CUSTOMER YANG SEDANG LOGIN
========================================= */
$id_customer = $_SESSION['customer'];

$query = mysqli_query(
    $conn,
    "SELECT * FROM customer WHERE id_customer='$id_customer'"
);

if (mysqli_num_rows($query) == 0) {
    session_destroy();
    header("Location: ../login.php");
    exit;
}

$data = mysqli_fetch_assoc($query);

$nama = $data['nama'];
$email = $data['email'];
$no_hp = $data['no_hp'];
$alamat = isset($data['alamat']) ? $data['alamat'] : '';
$status_verifikasi = $data['status_verifikasi'];

/* =========================================
   STATUS VERIFIKASI
========================================= */
if ($status_verifikasi == 'sudah') {
    $status_text = "Terverifikasi";
    $status_class = "verified";
} else {
    $status_text = "Belum Terverifikasi";
    $status_class = "not-verified";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Akun Saya - Rental Mobil</title>

<style>

/* =========================================
   RESET
========================================= */

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, Helvetica, sans-serif;

    min-height: 100vh;

    background: linear-gradient(
        120deg,
        #383232,
        #3e3b3b,
        #0b080b,
        #4f4c4c
    );

    background-size: 400% 400%;
    animation: backgroundMove 12s ease infinite;

    color: #222;
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

    padding: 18px 6%;

    display: flex;

    justify-content: space-between;
    align-items: center;

    background: rgba(20, 18, 20, 0.75);

    backdrop-filter: blur(12px);

    border-bottom: 1px solid rgba(255,255,255,0.1);

    position: sticky;

    top: 0;

    z-index: 100;
}

.logo {

    color: white;

    font-size: 21px;

    font-weight: bold;

    letter-spacing: 1px;
}

.nav-menu {

    display: flex;

    align-items: center;

    gap: 25px;
}

.nav-menu a {

    color: #ddd;

    text-decoration: none;

    font-size: 14px;

    transition: 0.3s;
}

.nav-menu a:hover {

    color: #b8afff;

}


/* =========================================
   CONTAINER
========================================= */

.container {

    width: 90%;

    max-width: 950px;

    margin: 50px auto 70px;
}


/* =========================================
   TITLE
========================================= */

.page-title {

    text-align: center;

    color: white;

    margin-bottom: 30px;
}

.page-title h1 {

    font-size: 32px;

    margin-bottom: 8px;
}

.page-title p {

    color: #ccc;

    font-size: 14px;
}


/* =========================================
   ACCOUNT CARD
========================================= */

.account-card {

    background: white;

    border-radius: 22px;

    padding: 35px;

    box-shadow:
        0 20px 50px rgba(0,0,0,0.35);

    position: relative;

    overflow: hidden;
}

.account-card::before {

    content: "";

    position: absolute;

    top: 0;
    left: 0;

    width: 100%;
    height: 5px;

    background: linear-gradient(
        90deg,
        #e0e0e6,
        #5b4de8,
        #47454c
    );

}


/* =========================================
   PROFILE HEADER
========================================= */

.profile-header {

    display: flex;

    align-items: center;

    gap: 20px;

    padding-bottom: 28px;

    border-bottom: 1px solid #eee;

    margin-bottom: 28px;
}

.profile-icon {

    width: 75px;

    height: 75px;

    border-radius: 50%;

    background: linear-gradient(
        135deg,
        #e0e0e6,
        #47454c
    );

    display: flex;

    justify-content: center;

    align-items: center;

    color: white;

    font-size: 32px;

    font-weight: bold;

    box-shadow:
        0 8px 20px rgba(0,0,0,0.15);
}

.profile-name h2 {

    font-size: 23px;

    margin-bottom: 6px;

    color: #222;
}

.profile-name p {

    font-size: 14px;

    color: #777;
}


/* =========================================
   INFORMATION
========================================= */

.section-title {

    font-size: 18px;

    margin-bottom: 20px;

    color: #29272d;
}

.info-grid {

    display: grid;

    grid-template-columns: repeat(2, 1fr);

    gap: 18px;

    margin-bottom: 30px;
}

.info-box {

    background: #f7f7f8;

    border: 1px solid #e8e8ea;

    border-radius: 13px;

    padding: 17px;

    transition: 0.3s;
}

.info-box:hover {

    transform: translateY(-2px);

    box-shadow:
        0 7px 18px rgba(0,0,0,0.07);
}

.info-label {

    font-size: 12px;

    color: #888;

    margin-bottom: 7px;

    text-transform: uppercase;

    letter-spacing: 0.5px;
}

.info-value {

    font-size: 15px;

    color: #29272d;

    word-break: break-word;
}

.full-width {

    grid-column: 1 / -1;
}


/* =========================================
   STATUS
========================================= */

.status {

    display: inline-block;

    padding: 6px 12px;

    border-radius: 20px;

    font-size: 12px;

    font-weight: bold;
}

.verified {

    background: #e5f8eb;

    color: #16813b;
}

.not-verified {

    background: #fff1d8;

    color: #9a6500;
}


/* =========================================
   BUTTON
========================================= */

.action-buttons {

    display: flex;

    gap: 14px;

    padding-top: 5px;
}

.btn {

    flex: 1;

    text-decoration: none;

    text-align: center;

    padding: 14px 20px;

    border-radius: 11px;

    font-size: 14px;

    font-weight: bold;

    transition: 0.3s;

    border: none;

    cursor: pointer;
}

.btn-edit {

    color: white;

    background: linear-gradient(
        135deg,
        #e0e0e6,
        #47454c
    );
}

.btn-password {

    color: #3f3b46;

    background: #eeeeef;

    border: 1px solid #ddd;
}

.btn:hover {

    transform: translateY(-2px);

    box-shadow:
        0 8px 18px rgba(0,0,0,0.15);
}


/* =========================================
   BACK
========================================= */

.back-dashboard {

    text-align: center;

    margin-top: 22px;
}

.back-dashboard a {

    color: #cfcfcf;

    text-decoration: none;

    font-size: 14px;

    transition: 0.3s;
}

.back-dashboard a:hover {

    color: white;
}


/* =========================================
   RESPONSIVE
========================================= */

@media (max-width: 700px) {

    .navbar {

        padding: 16px 5%;
    }

    .nav-menu {

        gap: 12px;
    }

    .nav-menu a {

        font-size: 12px;
    }

    .container {

        width: 94%;

        margin-top: 30px;
    }

    .account-card {

        padding: 23px;
    }

    .profile-header {

        align-items: flex-start;
    }

    .profile-icon {

        width: 60px;

        height: 60px;

        font-size: 25px;
    }

    .profile-name h2 {

        font-size: 19px;
    }

    .info-grid {

        grid-template-columns: 1fr;
    }

    .full-width {

        grid-column: auto;
    }

    .action-buttons {

        flex-direction: column;
    }

}

</style>

</head>

<body>


<!-- =========================================
     NAVBAR
========================================= -->

<nav class="navbar">

    <div class="logo">
        RENTAL MOBIL
    </div>

    <div class="nav-menu">

        <a href="../index.php">
            Home
        </a>

        <a href="../armada.php">
            Armada
        </a>

        <a href="dashboard.php">
            Dashboard
        </a>

        <a href="../logout.php">
            Logout
        </a>

    </div>

</nav>


<!-- =========================================
     CONTENT
========================================= -->

<div class="container">

    <div class="page-title">

        <h1>Akun Saya</h1>

        <p>
            Kelola informasi akun dan data pribadi Anda
        </p>

    </div>


    <div class="account-card">


        <!-- PROFILE HEADER -->

        <div class="profile-header">

            <div class="profile-icon">

                <?php
                echo strtoupper(substr($nama, 0, 1));
                ?>

            </div>

            <div class="profile-name">

                <h2>
                    <?= htmlspecialchars($nama); ?>
                </h2>

                <p>
                    <?= htmlspecialchars($email); ?>
                </p>

            </div>

        </div>


        <!-- INFORMATION -->

        <h3 class="section-title">
            Informasi Pribadi
        </h3>


        <div class="info-grid">


            <!-- NAMA -->

            <div class="info-box">

                <div class="info-label">
                    Nama Lengkap
                </div>

                <div class="info-value">

                    <?= htmlspecialchars($nama); ?>

                </div>

            </div>


            <!-- EMAIL -->

            <div class="info-box">

                <div class="info-label">
                    Email
                </div>

                <div class="info-value">

                    <?= htmlspecialchars($email); ?>

                </div>

            </div>


            <!-- NO HP -->

            <div class="info-box">

                <div class="info-label">
                    Nomor HP
                </div>

                <div class="info-value">

                    <?php

                    if (!empty($no_hp)) {

                        echo htmlspecialchars($no_hp);

                    } else {

                        echo "Belum diisi";

                    }

                    ?>

                </div>

            </div>


            <!-- STATUS -->

            <div class="info-box">

                <div class="info-label">
                    Status Akun
                </div>

                <div class="info-value">

                    <span class="status <?= $status_class; ?>">

                        <?= $status_text; ?>

                    </span>

                </div>

            </div>


            <!-- ALAMAT -->

            <div class="info-box full-width">

                <div class="info-label">
                    Alamat
                </div>

                <div class="info-value">

                    <?php

                    if (!empty($alamat)) {

                        echo nl2br(htmlspecialchars($alamat));

                    } else {

                        echo "Alamat belum diisi";

                    }

                    ?>

                </div>

            </div>


        </div>


        <!-- BUTTON -->

        <div class="action-buttons">

            <a
                href="edit_akun.php"
                class="btn btn-edit"
            >
                ✏️ Edit Profil
            </a>

            <a
                href="ubah_password.php"
                class="btn btn-password"
            >
                🔒 Ubah Password
            </a>

        </div>


    </div>


    <div class="back-dashboard">

        <a href="dashboard.php">
            ← Kembali ke Dashboard
        </a>

    </div>

</div>

</body>
</html>
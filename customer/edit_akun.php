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
   AMBIL ID CUSTOMER
========================================= */

$id_customer = $_SESSION['customer'];


/* =========================================
   AMBIL DATA CUSTOMER
========================================= */

$query = mysqli_query(
    $conn,
    "SELECT * FROM customer
     WHERE id_customer='$id_customer'"
);

if (mysqli_num_rows($query) == 0) {

    session_destroy();

    header("Location: ../login.php");

    exit;
}

$data = mysqli_fetch_assoc($query);


/* =========================================
   DATA AWAL
========================================= */

$nama = $data['nama'];
$email = $data['email'];
$no_hp = $data['no_hp'];

$alamat = isset($data['alamat'])
    ? $data['alamat']
    : '';


/* =========================================
   PROSES UPDATE
========================================= */

if (isset($_POST['simpan'])) {

    $nama_baru = mysqli_real_escape_string(
        $conn,
        $_POST['nama']
    );

    $no_hp_baru = mysqli_real_escape_string(
        $conn,
        $_POST['no_hp']
    );

    $alamat_baru = mysqli_real_escape_string(
        $conn,
        $_POST['alamat']
    );


    $update = mysqli_query(
        $conn,
        "UPDATE customer SET
            nama='$nama_baru',
            no_hp='$no_hp_baru',
            alamat='$alamat_baru'
         WHERE id_customer='$id_customer'"
    );


    if ($update) {

        /* Update session nama */

        $_SESSION['nama_customer'] = $nama_baru;


        echo "<script>

                alert('Data akun berhasil diperbarui!');

                window.location='akun.php';

              </script>";

        exit;

    } else {

        echo "<script>

                alert('Gagal memperbarui data akun!');

              </script>";

    }

}

?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
>

<title>Edit Akun - Rental Mobil</title>


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

    padding: 18px 6%;

    display: flex;

    justify-content: space-between;

    align-items: center;

    background: rgba(20,18,20,0.75);

    backdrop-filter: blur(12px);

    border-bottom: 1px solid rgba(255,255,255,0.1);
}


.logo {

    color: white;

    font-size: 21px;

    font-weight: bold;

    letter-spacing: 1px;
}


.nav-menu {

    display: flex;

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

    max-width: 700px;

    margin: 50px auto;
}


/* =========================================
   TITLE
========================================= */

.title {

    text-align: center;

    color: white;

    margin-bottom: 25px;
}


.title h1 {

    font-size: 30px;

    margin-bottom: 8px;
}


.title p {

    color: #ccc;

    font-size: 14px;
}


/* =========================================
   FORM CARD
========================================= */

.form-card {

    background: white;

    border-radius: 20px;

    padding: 35px;

    box-shadow:
        0 20px 50px rgba(0,0,0,0.35);

    position: relative;

    overflow: hidden;
}


.form-card::before {

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
   FORM GROUP
========================================= */

.form-group {

    margin-bottom: 20px;
}


.form-group label {

    display: block;

    margin-bottom: 8px;

    font-size: 13px;

    font-weight: bold;

    color: #444;
}


.form-group input,
.form-group textarea {

    width: 100%;

    padding: 13px 15px;

    border: 1px solid #ddd;

    border-radius: 10px;

    outline: none;

    font-size: 14px;

    font-family: Arial, Helvetica, sans-serif;

    transition: 0.3s;

}


.form-group input:focus,
.form-group textarea:focus {

    border-color: #5b4de8;

    box-shadow:
        0 0 0 3px rgba(91,77,232,0.10);
}


.form-group textarea {

    min-height: 120px;

    resize: vertical;
}


/* =========================================
   EMAIL
========================================= */

.email-info {

    background: #f5f5f6;

    border: 1px solid #e5e5e6;

    padding: 13px 15px;

    border-radius: 10px;

    color: #777;

    font-size: 14px;
}


.email-note {

    font-size: 11px;

    color: #999;

    margin-top: 6px;
}


/* =========================================
   BUTTON
========================================= */

.buttons {

    display: flex;

    gap: 12px;

    margin-top: 25px;
}


.btn {

    flex: 1;

    padding: 14px;

    border-radius: 10px;

    text-decoration: none;

    text-align: center;

    font-size: 14px;

    font-weight: bold;

    cursor: pointer;

    transition: 0.3s;

    border: none;
}


.btn-save {

    color: white;

    background: linear-gradient(
        135deg,
        #e0e0e6,
        #47454c
    );
}


.btn-cancel {

    background: #eeeeef;

    color: #444;

    border: 1px solid #ddd;
}


.btn:hover {

    transform: translateY(-2px);

    box-shadow:
        0 7px 17px rgba(0,0,0,0.15);
}


/* =========================================
   RESPONSIVE
========================================= */

@media (max-width: 600px) {

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

    .form-card {

        padding: 25px 20px;
    }

    .buttons {

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

    </div>

</nav>


<!-- =========================================
     CONTENT
========================================= -->

<div class="container">


    <div class="title">

        <h1>Edit Profil</h1>

        <p>
            Perbarui informasi pribadi akun Anda
        </p>

    </div>


    <div class="form-card">


        <form method="POST">


            <!-- NAMA -->

            <div class="form-group">

                <label for="nama">
                    Nama Lengkap
                </label>

                <input
                    type="text"
                    id="nama"
                    name="nama"
                    value="<?= htmlspecialchars($nama); ?>"
                    minlength="3"
                    required
                >

            </div>


            <!-- EMAIL -->

            <div class="form-group">

                <label>
                    Email
                </label>

                <div class="email-info">

                    <?= htmlspecialchars($email); ?>

                </div>

                <div class="email-note">

                    Email tidak dapat diubah karena digunakan
                    sebagai identitas login.

                </div>

            </div>


            <!-- NO HP -->

            <div class="form-group">

                <label for="no_hp">
                    Nomor HP
                </label>

                <input
                    type="tel"
                    id="no_hp"
                    name="no_hp"
                    value="<?= htmlspecialchars($no_hp); ?>"
                    pattern="[0-9]{10,13}"
                    minlength="10"
                    maxlength="13"
                    placeholder="Contoh: 081234567890"
                >

            </div>


            <!-- ALAMAT -->

            <div class="form-group">

                <label for="alamat">
                    Alamat
                </label>

                <textarea
                    id="alamat"
                    name="alamat"
                    placeholder="Masukkan alamat lengkap Anda..."
                ><?= htmlspecialchars($alamat); ?></textarea>

            </div>


            <!-- BUTTON -->

            <div class="buttons">

                <a
                    href="akun.php"
                    class="btn btn-cancel"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    name="simpan"
                    class="btn btn-save"
                >
                    Simpan Perubahan
                </button>

            </div>


        </form>


    </div>

</div>

</body>

</html>
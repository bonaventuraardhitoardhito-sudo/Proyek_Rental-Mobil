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


$id_customer = $_SESSION['customer'];


/* =========================================
   PROSES UBAH PASSWORD
========================================= */

if (isset($_POST['ubah_password'])) {

    $password_lama = md5($_POST['password_lama']);

    $password_baru = $_POST['password_baru'];

    $konfirmasi = $_POST['konfirmasi'];


    /* =========================================
       CEK PASSWORD LAMA
    ========================================= */

    $cek = mysqli_query(
        $conn,
        "SELECT * FROM customer
         WHERE id_customer='$id_customer'
         AND password='$password_lama'"
    );


    if (mysqli_num_rows($cek) == 0) {

        echo "<script>

                alert('Password lama salah!');

              </script>";

    } else {


        /* =========================================
           CEK PASSWORD BARU
        ========================================= */

        if ($password_baru !== $konfirmasi) {

            echo "<script>

                    alert('Konfirmasi password tidak cocok!');

                  </script>";

        } elseif (strlen($password_baru) < 8) {

            echo "<script>

                    alert('Password baru minimal 8 karakter!');

                  </script>";

        } else {


            /* =========================================
               UPDATE PASSWORD
            ========================================= */

            $password_baru_md5 = md5($password_baru);


            $update = mysqli_query(
                $conn,
                "UPDATE customer SET
                    password='$password_baru_md5'
                 WHERE id_customer='$id_customer'"
            );


            if ($update) {

                echo "<script>

                        alert('Password berhasil diubah!');

                        window.location='akun.php';

                      </script>";

                exit;

            } else {

                echo "<script>

                        alert('Gagal mengubah password!');

                      </script>";

            }

        }

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

<title>Ubah Password - Rental Mobil</title>


<style>

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

}


.nav-menu {

    display: flex;

    gap: 25px;

}


.nav-menu a {

    color: #ddd;

    text-decoration: none;

    font-size: 14px;

}


.container {

    width: 90%;

    max-width: 600px;

    margin: 60px auto;

}


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


.form-card {

    background: white;

    padding: 35px;

    border-radius: 20px;

    box-shadow:
        0 20px 50px rgba(0,0,0,0.35);

}


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


.form-group input {

    width: 100%;

    padding: 13px;

    border: 1px solid #ddd;

    border-radius: 10px;

    outline: none;

    font-size: 14px;

}


.form-group input:focus {

    border-color: #5b4de8;

    box-shadow:
        0 0 0 3px rgba(91,77,232,0.10);

}


.buttons {

    display: flex;

    gap: 12px;

    margin-top: 25px;

}


.btn {

    flex: 1;

    padding: 14px;

    border-radius: 10px;

    border: none;

    text-decoration: none;

    text-align: center;

    font-weight: bold;

    cursor: pointer;

}


.btn-save {

    background: linear-gradient(
        135deg,
        #e0e0e6,
        #47454c
    );

    color: white;

}


.btn-cancel {

    background: #eee;

    color: #444;

}


@media (max-width: 600px) {

    .buttons {

        flex-direction: column;

    }

}

</style>

</head>


<body>


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


<div class="container">


    <div class="title">

        <h1>Ubah Password</h1>

        <p>
            Gunakan password baru untuk akun Anda
        </p>

    </div>


    <div class="form-card">


        <form method="POST">


            <div class="form-group">

                <label>
                    Password Lama
                </label>

                <input
                    type="password"
                    name="password_lama"
                    minlength="8"
                    required
                >

            </div>


            <div class="form-group">

                <label>
                    Password Baru
                </label>

                <input
                    type="password"
                    name="password_baru"
                    minlength="8"
                    required
                >

            </div>


            <div class="form-group">

                <label>
                    Konfirmasi Password Baru
                </label>

                <input
                    type="password"
                    name="konfirmasi"
                    minlength="8"
                    required
                >

            </div>


            <div class="buttons">

                <a
                    href="akun.php"
                    class="btn btn-cancel"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    name="ubah_password"
                    class="btn btn-save"
                >
                    Ubah Password
                </button>

            </div>


        </form>


    </div>

</div>


</body>

</html>
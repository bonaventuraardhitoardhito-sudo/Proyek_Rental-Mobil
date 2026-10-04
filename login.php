<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include "config/koneksi.php";

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $query = mysqli_query($conn,
        "SELECT * FROM customer
         WHERE email='$email'
         AND password='$password'"
    );

    if (mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);

        $_SESSION['customer'] = $data['id_customer'];
        $_SESSION['nama_customer'] = $data['nama'];

        echo "<script>
                alert('Login berhasil!');
                window.location='customer/dashboard.php';
              </script>";
    } else {
        echo "<script>
                alert('Email atau Password salah!');
              </script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Customer</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;

            background: linear-gradient(
                135deg,
                #6f91b5,
                #4fa0ed
            );

            min-height: 100vh;

            display: flex;
            justify-content: center;
            align-items: center;

            padding: 20px;
        }

        /* =========================
           KOTAK LOGIN
           ========================= */

        .form-box {
            position: relative;

            background: #ffffff;

            width: 380px;

            padding: 30px 32px 25px;

            border-radius: 20px;

            box-shadow:
                0 15px 35px rgba(0, 0, 0, 0.17);

            overflow: hidden;
        }

        /* Garis biru di bagian atas */

        .form-box::before {
            content: "";

            position: absolute;

            top: 0;
            left: 0;

            width: 100%;
            height: 4px;

            background: linear-gradient(
                90deg,
                #1267c5,
                #1a7de7,
                #5aa9ff
            );
        }

        /* =========================
           ICON
           ========================= */

        .logo {
            width: 48px;
            height: 48px;

            margin: 0 auto 12px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: #eaf4ff;

            border-radius: 50%;

            font-size: 22px;
        }

        /* =========================
           JUDUL
           ========================= */

        .form-box h2 {
            text-align: center;

            color: #1d2733;

            font-size: 24px;

            margin-bottom: 6px;
        }

        .subtitle {
            text-align: center;

            color: #7a8794;

            font-size: 12px;

            line-height: 1.4;

            margin-bottom: 22px;
        }

        /* =========================
           INPUT
           ========================= */

        .form-group {
            margin-bottom: 16px;
        }

        .form-group label {
            display: block;

            color: #273444;

            font-weight: 600;

            font-size: 13px;

            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;

            height: 40px;

            padding: 9px 12px;

            border: 1px solid #d9e0e7;

            border-radius: 9px;

            background-color: #fafcff;

            font-size: 13px;

            color: #222;

            outline: none;

            transition: 0.25s;
        }

        .form-group input::placeholder {
            color: #a0aab5;
        }

        .form-group input:hover {
            border-color: #b9c7d6;

            background-color: #ffffff;
        }

        .form-group input:focus {
            border-color: #1a7de7;

            background-color: #ffffff;

            box-shadow:
                0 0 0 3px rgba(26, 125, 231, 0.10);
        }

        /* =========================
           VALIDASI
           ========================= */

        .form-group input:invalid:not(:placeholder-shown) {
            border-color: #e74c3c;
        }

        /* =========================
           BUTTON
           ========================= */

        .btn {
            width: 100%;

            height: 42px;

            margin-top: 4px;

            border: none;

            border-radius: 9px;

            background: linear-gradient(
                135deg,
                #1267c5,
                #1a7de7
            );

            color: white;

            font-size: 14px;

            font-weight: bold;

            cursor: pointer;

            transition: 0.25s;

            box-shadow:
                0 5px 12px rgba(26, 125, 231, 0.22);
        }

        .btn:hover {
            transform: translateY(-1px);

            box-shadow:
                0 7px 16px rgba(26, 125, 231, 0.30);
        }

        .btn:active {
            transform: translateY(0);
        }

        /* =========================
           REGISTER
           ========================= */

        .register {
            text-align: center;

            margin-top: 18px;

            color: #7a8794;

            font-size: 12px;
        }

        .register a {
            color: #1a7de7;

            text-decoration: none;

            font-weight: bold;
        }

        .register a:hover {
            text-decoration: underline;
        }

        /* =========================
           RESPONSIVE
           ========================= */

        @media (max-width: 450px) {

            body {
                padding: 15px;
            }

            .form-box {
                width: 100%;

                padding: 28px 25px 23px;
            }
        }
    </style>
</head>

<body>

<div class="form-box">

    <!-- Icon -->
    <div class="logo">
        🚗
    </div>

    <!-- Judul -->
    <h2>Login Customer</h2>

    <p class="subtitle">
        Silakan masuk untuk melanjutkan
    </p>

    <form method="POST" autocomplete="off">

        <!-- EMAIL -->
        <div class="form-group">

            <label>Email</label>

            <input
                type="email"
                name="email"
                placeholder="Masukkan email"
                autocomplete="off"
                required
            >

        </div>


        <!-- PASSWORD -->
        <div class="form-group">

            <label>Password</label>

            <input
                type="password"
                name="password"
                placeholder="Masukkan password"
                autocomplete="new-password"
                required
            >

        </div>


        <!-- BUTTON -->
        <button
            type="submit"
            name="login"
            class="btn"
        >
            Login
        </button>

    </form>


    <!-- REGISTER -->
    <p class="register">

        Belum punya akun?

        <a href="register.php">
            Register
        </a>

    </p>

</div>

</body>
</html>
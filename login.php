<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include "config/koneksi.php";

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $query = mysqli_query(
        $conn,
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

        /* =========================================
           RESET
           ========================================= */

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }


        /* =========================================
           BODY
           ========================================= */

        body {

            font-family: Arial, sans-serif;

            min-height: 100vh;

            display: flex;

            justify-content: center;

            align-items: center;

            padding: 30px;

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


        /* Background halaman bergerak */

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
           CARD UTAMA
           ========================================= */

        .login-container {

            position: relative;

            width: 900px;

            height: 500px;

            background: white;

            border-radius: 20px;

            overflow: hidden;

            display: flex;

            box-shadow:
                0 25px 60px rgba(55, 45, 100, 0.20);
        }


        /* =========================================
           BAGIAN KIRI
           ========================================= */

        .left-section {

            position: relative;

            width: 55%;

            height: 100%;

            overflow: hidden;

            color: white;

            display: flex;

            align-items: center;

            justify-content: center;

            text-align: center;

            background: linear-gradient(
                135deg,
                #434043,
                #3f3d43,
                #0d0412,
                #323236
            );

            background-size: 300% 300%;

            animation: purpleMove 10s ease infinite;
        }


        /* Gradient kiri bergerak */

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


        /* =========================================
           LINGKARAN DEKORASI
           ========================================= */

        .circle {

            position: absolute;

            border-radius: 50%;

            background: rgba(255, 255, 255, 0.10);

            pointer-events: none;
        }


        .circle-1 {

            width: 350px;

            height: 350px;

            left: -170px;

            bottom: -130px;

            animation: floatOne 9s ease-in-out infinite;
        }


        .circle-2 {

            width: 280px;

            height: 280px;

            right: -150px;

            top: -130px;

            animation: floatTwo 11s ease-in-out infinite;
        }


        .circle-3 {

            width: 170px;

            height: 170px;

            left: 60px;

            top: -80px;

            background: rgba(255, 255, 255, 0.08);

            animation: floatThree 7s ease-in-out infinite;
        }


        .circle-4 {

            width: 100px;

            height: 100px;

            right: 40px;

            bottom: 40px;

            background: rgba(255, 255, 255, 0.12);

            animation: floatFour 8s ease-in-out infinite;
        }


        @keyframes floatOne {

            0% {
                transform: translate(0, 0);
            }

            50% {
                transform: translate(30px, -25px);
            }

            100% {
                transform: translate(0, 0);
            }
        }


        @keyframes floatTwo {

            0% {
                transform: translate(0, 0);
            }

            50% {
                transform: translate(-35px, 25px);
            }

            100% {
                transform: translate(0, 0);
            }
        }


        @keyframes floatThree {

            0% {
                transform: translate(0, 0) scale(1);
            }

            50% {
                transform: translate(20px, 25px) scale(1.08);
            }

            100% {
                transform: translate(0, 0) scale(1);
            }
        }


        @keyframes floatFour {

            0% {
                transform: translate(0, 0);
            }

            50% {
                transform: translate(-20px, -20px);
            }

            100% {
                transform: translate(0, 0);
            }
        }


        /* =========================================
           BINTANG / TITIK
           ========================================= */

        .dot {

            position: absolute;

            width: 6px;

            height: 6px;

            border-radius: 50%;

            background: rgba(255, 255, 255, 0.8);

            animation: twinkle 3s ease-in-out infinite;
        }


        .dot-1 {
            top: 70px;
            left: 90px;
        }

        .dot-2 {
            top: 120px;
            left: 180px;
            animation-delay: 0.7s;
        }

        .dot-3 {
            top: 80px;
            right: 100px;
            animation-delay: 1.4s;
        }

        .dot-4 {
            bottom: 100px;
            left: 130px;
            animation-delay: 2s;
        }

        .dot-5 {
            bottom: 70px;
            right: 150px;
            animation-delay: 0.5s;
        }

        .dot-6 {
            top: 190px;
            right: 60px;
            animation-delay: 1.8s;
        }


        @keyframes twinkle {

            0% {
                opacity: 0.3;

                transform: scale(0.8);
            }

            50% {
                opacity: 1;

                transform: scale(1.4);
            }

            100% {
                opacity: 0.3;

                transform: scale(0.8);
            }
        }


        /* =========================================
           KONTEN RENTAL MOBIL
           ========================================= */

        .welcome-content {

            position: relative;

            z-index: 5;

            width: 80%;

            margin-bottom: 70px;
        }


        .welcome-icon {

            width: 76px;

            height: 76px;

            margin: 0 auto 20px;

            border-radius: 50%;

            background: rgba(255, 255, 255, 0.15);

            border: 1px solid rgba(255, 255, 255, 0.30);

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 35px;

            box-shadow:
                0 5px 20px rgba(0, 0, 0, 0.10);

            animation: iconFloat 3s ease-in-out infinite;
        }


        @keyframes iconFloat {

            0% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-7px);
            }

            100% {
                transform: translateY(0);
            }
        }


        .welcome-content h1 {

            font-size: 36px;

            margin-bottom: 12px;

            letter-spacing: -1px;
        }


        .welcome-content p {

            font-size: 14px;

            line-height: 1.7;

            color: rgba(151, 146, 146, 0.88);
        }


        /* =========================================
           ANIMASI JALAN
           ========================================= */

        .road-animation {

            position: absolute;

            left: 0;

            bottom: 25px;

            width: 100%;

            height: 80px;

            z-index: 6;

            overflow: hidden;
        }


        /* Jalan */

        .road {

            position: absolute;

            left: 0;

            bottom: 10px;

            width: 100%;

            height: 3px;

            background: rgba(255, 255, 255, 0.30);
        }


        /* Garis jalan */

        .road::after {

            content: "";

            position: absolute;

            left: 0;

            top: 13px;

            width: 100%;

            height: 3px;

            background: repeating-linear-gradient(
                to right,
                rgba(255,255,255,0.85) 0px,
                rgba(255,255,255,0.85) 35px,
                transparent 35px,
                transparent 75px
            );

            animation: roadMove 1.2s linear infinite;
        }


        @keyframes roadMove {

            from {
                background-position: 0 0;
            }

            to {
                background-position: -75px 0;
            }
        }


        /* =========================================
           MOBIL
           ========================================= */

        .car {

            position: absolute;

            left: -110px;

            bottom: 18px;

            width: 90px;

            height: 50px;

            z-index: 8;

            animation: carMove 8s linear infinite;
        }


        @keyframes carMove {

            0% {

                left: -110px;

                transform: translateY(0);
            }

            10% {

                transform: translateY(-2px);
            }

            20% {

                transform: translateY(0);
            }

            30% {

                transform: translateY(-2px);
            }

            40% {

                transform: translateY(0);
            }

            50% {

                transform: translateY(-2px);
            }

            60% {

                transform: translateY(0);
            }

            70% {

                transform: translateY(-2px);
            }

            80% {

                transform: translateY(0);
            }

            100% {

                left: 100%;

                transform: translateY(0);
            }
        }


        /* Body mobil */

        .car-body {

            position: absolute;

            left: 0;

            bottom: 8px;

            width: 85px;

            height: 25px;

            background: #ffffff;

            border-radius: 7px 12px 5px 5px;

            box-shadow:
                0 4px 8px rgba(0, 0, 0, 0.20);
        }


        /* Atap mobil */

        .car-body::before {

            content: "";

            position: absolute;

            left: 18px;

            top: -18px;

            width: 50px;

            height: 23px;

            background: #ffffff;

            border-radius: 20px 20px 3px 3px;
        }


        /* =========================================
           KACA MOBIL
           ========================================= */

        .car-window {

            position: absolute;

            top: -13px;

            width: 18px;

            height: 13px;

            background: #f9f8fc;

            z-index: 2;
        }


        .window-left {

            left: 23px;

            border-radius: 8px 2px 2px 2px;
        }


        .window-right {

            left: 44px;

            border-radius: 2px 8px 2px 2px;
        }


        /* =========================================
           RODA
           ========================================= */

        .wheel {

            position: absolute;

            bottom: -8px;

            width: 18px;

            height: 18px;

            background: #202020;

            border-radius: 50%;

            border: 4px solid #ffffff;

            animation: wheelSpin 0.5s linear infinite;
        }


        .wheel-left {
            left: 12px;
        }


        .wheel-right {
            right: 12px;
        }


        @keyframes wheelSpin {

            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }


        /* =========================================
           EFEK ANGIN
           ========================================= */

        .wind {

            position: absolute;

            height: 2px;

            background: rgba(255,255,255,0.55);

            border-radius: 10px;

            opacity: 0;

            animation: windMove 2s linear infinite;
        }


        .wind-1 {

            width: 30px;

            bottom: 48px;

            left: 15%;

            animation-delay: 0s;
        }


        .wind-2 {

            width: 20px;

            bottom: 60px;

            left: 40%;

            animation-delay: 0.7s;
        }


        .wind-3 {

            width: 27px;

            bottom: 42px;

            left: 65%;

            animation-delay: 1.3s;
        }


        @keyframes windMove {

            0% {

                transform: translateX(0);

                opacity: 0;
            }

            20% {

                opacity: 0.7;
            }

            100% {

                transform: translateX(-100px);

                opacity: 0;
            }
        }


        /* =========================================
           BAGIAN KANAN
           ========================================= */

        .right-section {

            width: 45%;

            display: flex;

            align-items: center;

            justify-content: center;

            background: #ffffff;

            padding: 40px;
        }


        .login-box {

            width: 100%;

            max-width: 300px;
        }


        /* =========================================
           JUDUL LOGIN
           ========================================= */

        .login-box h2 {

            color: #202938;

            font-size: 27px;

            margin-bottom: 7px;
        }


        .login-subtitle {

            color: #8a94a3;

            font-size: 13px;

            margin-bottom: 28px;

            line-height: 1.5;
        }


        /* =========================================
           INPUT
           ========================================= */

        .form-group {

            margin-bottom: 18px;
        }


        .form-group label {

            display: block;

            color: #374151;

            font-size: 13px;

            font-weight: 600;

            margin-bottom: 7px;
        }


        .form-group input {

            width: 100%;

            height: 42px;

            padding: 10px 13px;

            border: 1px solid #dce1e8;

            border-radius: 9px;

            background: #fafbfc;

            font-size: 13px;

            color: #222;

            outline: none;

            transition: 0.25s;
        }


        .form-group input::placeholder {

            color: #a5adb8;
        }


        .form-group input:focus {

            background: white;

            border-color: #5c5c68;

            box-shadow:
                0 0 0 3px rgba(99, 102, 241, 0.10);
        }


        .form-group input:invalid:not(:placeholder-shown) {

            border-color: #e74c3c;
        }


        /* =========================================
           BUTTON LOGIN
           ========================================= */

        .btn {

            width: 100%;

            height: 43px;

            margin-top: 5px;

            border: none;

            border-radius: 9px;

            background: linear-gradient(
                135deg,
                #e0e0e6,
                #47454c
            );

            color: white;

            font-size: 14px;

            font-weight: bold;

            cursor: pointer;

            transition: 0.25s;

            box-shadow:
                0 6px 15px rgba(79, 70, 229, 0.25);
        }


        .btn:hover {

            transform: translateY(-2px);

            box-shadow:
                0 9px 20px rgba(79, 70, 229, 0.35);
        }


        .btn:active {

            transform: translateY(0);
        }


        /* =========================================
           REGISTER
           ========================================= */

        .register {

            text-align: center;

            margin-top: 22px;

            color: #8a94a3;

            font-size: 12px;
        }


        .register a {

            color: #5b4de8;

            text-decoration: none;

            font-weight: bold;
        }


        .register a:hover {

            text-decoration: underline;
        }


        /* =========================================
           RESPONSIVE
           ========================================= */

        @media (max-width: 750px) {

            body {

                padding: 20px;
            }


            .login-container {

                width: 400px;

                height: auto;

                display: block;
            }


            .left-section {

                width: 100%;

                height: 230px;
            }


            .right-section {

                width: 100%;

                padding: 35px 30px;
            }


            .welcome-content {

                width: 85%;

                margin-bottom: 50px;
            }


            .welcome-icon {

                width: 55px;

                height: 55px;

                font-size: 25px;

                margin-bottom: 10px;
            }


            .welcome-content h1 {

                font-size: 24px;
            }


            .welcome-content p {

                font-size: 12px;
            }


            .road-animation {

                bottom: 15px;
            }
        }


        @media (max-width: 450px) {

            .login-container {

                width: 100%;
            }


            .left-section {

                height: 210px;
            }


            .right-section {

                padding: 30px 25px;
            }
        }

    </style>

</head>


<body>


<div class="login-container">


    <!-- =========================================
         BAGIAN KIRI
         ========================================= -->

    <div class="left-section">


        <!-- Lingkaran dekorasi -->

        <div class="circle circle-1"></div>

        <div class="circle circle-2"></div>

        <div class="circle circle-3"></div>

        <div class="circle circle-4"></div>


        <!-- Titik dekorasi -->

        <div class="dot dot-1"></div>

        <div class="dot dot-2"></div>

        <div class="dot dot-3"></div>

        <div class="dot dot-4"></div>

        <div class="dot dot-5"></div>

        <div class="dot dot-6"></div>


        <!-- =====================================
             ANIMASI MOBIL
             ===================================== -->

        <div class="road-animation">


            <!-- Jalan -->

            <div class="road"></div>


            <!-- Mobil -->

            <div class="car">

                <div class="car-body">

                    <div class="car-window window-left"></div>

                    <div class="car-window window-right"></div>

                    <div class="wheel wheel-left"></div>

                    <div class="wheel wheel-right"></div>

                </div>

            </div>


            <!-- Efek angin -->

            <div class="wind wind-1"></div>

            <div class="wind wind-2"></div>

            <div class="wind wind-3"></div>


        </div>


        <!-- =====================================
             KONTEN
             ===================================== -->

        <div class="welcome-content">


            <div class="welcome-icon">

                🚗

            </div>


            <h1>

                Rental Mobil

            </h1>


            <p>

                Selamat datang kembali!

                <br>

                Login untuk melanjutkan perjalanan

                Anda bersama kami.

            </p>


        </div>


    </div>



    <!-- =========================================
         BAGIAN KANAN
         ========================================= -->

    <div class="right-section">


        <div class="login-box">


            <h2>

                Login Customer

            </h2>


            <p class="login-subtitle">

                Silakan masuk untuk melanjutkan

            </p>


            <form
                method="POST"
                autocomplete="off"
            >


                <!-- EMAIL -->

                <div class="form-group">

                    <label>

                        Email

                    </label>


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

                    <label>

                        Password

                    </label>


                    <input
                        type="password"
                        name="password"
                        placeholder="Masukkan password"
                        autocomplete="new-password"
                        minlength="8"
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

    </div>


</div>


</body>
</html>
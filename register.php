<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include "config/koneksi.php";

if (isset($_POST['register'])) {

    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];
    $password = md5($_POST['password']);

    $cek = mysqli_query(
        $conn,
        "SELECT * FROM customer WHERE email='$email'"
    );

    if (mysqli_num_rows($cek) > 0) {

        echo "<script>
                alert('Email sudah terdaftar!');
              </script>";

    } else {

        mysqli_query(
            $conn,
            "INSERT INTO customer(nama,email,no_hp,password,status_verifikasi)
             VALUES('$nama','$email','$no_hp','$password','belum')"
        );

        echo "<script>
                alert('Register berhasil! Silakan login.');
                window.location='login.php';
              </script>";
    }
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Register Customer</title>

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

            overflow: hidden;
        }


        /* =========================================
           BACKGROUND BERGERAK
           ========================================= */

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

        .register-container {

            position: relative;

            width: 900px;

            height: 600px;

            background: white;

            border-radius: 20px;

            overflow: hidden;

            display: flex;

            box-shadow:
                0 25px 60px rgba(0, 0, 0, 0.45);
        }


        /* =========================================
           BAGIAN KIRI
           ========================================= */

        .left-section {

            position: relative;

            width: 48%;

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


        /* =========================================
           GRADIENT KIRI BERGERAK
           ========================================= */

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


        /* =========================================
           ANIMASI LINGKARAN
           ========================================= */

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

                transform:
                    translate(0, 0)
                    scale(1);
            }

            50% {

                transform:
                    translate(20px, 25px)
                    scale(1.08);
            }

            100% {

                transform:
                    translate(0, 0)
                    scale(1);
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
           KONTEN KIRI
           ========================================= */

        .welcome-content {

            position: relative;

            z-index: 5;

            width: 80%;

            margin-bottom: 70px;
        }


        /* =========================================
           ICON
           ========================================= */

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


        /* =========================================
           TEXT KIRI
           ========================================= */

        .welcome-content h1 {

            font-size: 36px;

            margin-bottom: 12px;

            letter-spacing: -1px;
        }


        .welcome-content p {

            font-size: 14px;

            line-height: 1.7;

            color: rgba(220, 217, 217, 0.90);
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


        /* =========================================
           JALAN
           ========================================= */

        .road {

            position: absolute;

            left: 0;

            bottom: 10px;

            width: 100%;

            height: 3px;

            background: rgba(255, 255, 255, 0.30);
        }


        /* =========================================
           GARIS JALAN
           ========================================= */

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


        /* =========================================
           BODY MOBIL
           ========================================= */

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


        /* =========================================
           ATAP MOBIL
           ========================================= */

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

            width: 52%;

            display: flex;

            align-items: center;

            justify-content: center;

            background: #ffffff;

            padding: 35px 45px;
        }


        /* =========================================
           BOX REGISTER
           ========================================= */

        .register-box {

            width: 100%;

            max-width: 330px;
        }


        /* =========================================
           JUDUL REGISTER
           ========================================= */

        .register-box h2 {

            color: #202938;

            font-size: 27px;

            margin-bottom: 7px;
        }


        .register-subtitle {

            color: #8a94a3;

            font-size: 13px;

            margin-bottom: 20px;

            line-height: 1.5;
        }


        /* =========================================
           INPUT
           ========================================= */

        .form-group {

            margin-bottom: 12px;
        }


        .form-group label {

            display: block;

            color: #374151;

            font-size: 12px;

            font-weight: 600;

            margin-bottom: 5px;
        }


        .form-group input {

            width: 100%;

            height: 38px;

            padding: 9px 13px;

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


        .form-group input:valid:not(:placeholder-shown) {

            border-color: #2ecc71;
        }


        /* =========================================
           PESAN ERROR
           ========================================= */

        .error-message {

            display: none;

            color: #e74c3c;

            font-size: 10px;

            margin-top: 3px;
        }


        .form-group input:invalid:not(:placeholder-shown)
        + .error-message {

            display: block;
        }


        /* =========================================
           BUTTON REGISTER
           ========================================= */

        .btn {

            width: 100%;

            height: 42px;

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
                0 6px 15px rgba(50, 48, 55, 0.25);
        }


        .btn:hover {

            transform: translateY(-2px);

            box-shadow:
                0 9px 20px rgba(50, 48, 55, 0.35);
        }


        .btn:active {

            transform: translateY(0);
        }


        /* =========================================
           GOOGLE REGISTER
           ========================================= */

        .or-divider {

            display: flex;

            align-items: center;

            gap: 10px;

            margin: 16px 0;

            color: #a0a6b0;

            font-size: 11px;
        }


        .or-divider::before,
        .or-divider::after {

            content: "";

            flex: 1;

            height: 1px;

            background: #e1e4e8;
        }


        .google-btn {

            width: 100%;

            height: 42px;

            display: flex;

            align-items: center;

            justify-content: center;

            gap: 10px;

            background: #ffffff;

            color: #303030;

            border: 1px solid #dce1e8;

            border-radius: 9px;

            text-decoration: none;

            font-size: 13px;

            font-weight: 600;

            transition: 0.25s;

            box-shadow:
                0 4px 12px rgba(0, 0, 0, 0.08);
        }


        .google-btn:hover {

            transform: translateY(-2px);

            border-color: #b9bec7;

            box-shadow:
                0 7px 18px rgba(0, 0, 0, 0.13);
        }


        .google-icon {

            width: 22px;

            height: 22px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 50%;

            font-size: 17px;

            font-weight: bold;

            color: #4285F4;
        }


        /* =========================================
           LOGIN
           ========================================= */

        .login {

            text-align: center;

            margin-top: 17px;

            color: #8a94a3;

            font-size: 12px;
        }


        .login a {

            color: #5b4de8;

            text-decoration: none;

            font-weight: bold;
        }


        .login a:hover {

            text-decoration: underline;
        }


        /* =========================================
           RESPONSIVE
           ========================================= */

        @media (max-width: 750px) {

            body {

                padding: 20px;
            }


            .register-container {

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

            .register-container {

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


<div class="register-container">


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

                Buat akun baru Anda

                <br>

                dan mulai perjalanan bersama kami.

            </p>


        </div>


    </div>



    <!-- =========================================
         BAGIAN KANAN
         ========================================= -->

    <div class="right-section">


        <div class="register-box">


            <h2>

                Register Customer

            </h2>


            <p class="register-subtitle">

                Buat akun untuk mulai menggunakan layanan

            </p>


            <form
                method="POST"
                id="registerForm"
                autocomplete="off"
            >


                <!-- =================================
                     NAMA
                     ================================= -->

                <div class="form-group">

                    <label>

                        Nama

                    </label>


                    <input
                        type="text"
                        name="nama"
                        placeholder="Masukkan nama lengkap"
                        pattern="[A-Za-zÀ-ÿ\s]+"
                        minlength="3"
                        autocomplete="off"
                        required
                    >


                    <small class="error-message">

                        Nama hanya boleh berisi huruf
                        dan minimal 3 karakter.

                    </small>

                </div>



                <!-- =================================
                     EMAIL
                     ================================= -->

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


                    <small class="error-message">

                        Masukkan alamat email yang valid.

                    </small>

                </div>



                <!-- =================================
                     NO HP
                     ================================= -->

                <div class="form-group">

                    <label>

                        No HP

                    </label>


                    <input
                        type="tel"
                        name="no_hp"
                        placeholder="Masukkan nomor HP"
                        pattern="[0-9]{10,13}"
                        minlength="10"
                        maxlength="13"
                        autocomplete="off"
                        required
                    >


                    <small class="error-message">

                        Nomor HP harus berupa angka
                        10–13 digit.

                    </small>

                </div>



                <!-- =================================
                     PASSWORD
                     ================================= -->

                <div class="form-group">

                    <label>

                        Password

                    </label>


                    <input
                        type="password"
                        name="password"
                        id="password"
                        placeholder="Minimal 8 karakter"
                        minlength="8"
                        autocomplete="new-password"
                        required
                    >


                    <small class="error-message">

                        Password harus minimal 8 karakter.

                    </small>

                </div>



                <!-- =================================
                     KONFIRMASI PASSWORD
                     ================================= -->

                <div class="form-group">

                    <label>

                        Konfirmasi Password

                    </label>


                    <input
                        type="password"
                        name="konfirmasi_password"
                        id="konfirmasi_password"
                        placeholder="Masukkan password kembali"
                        autocomplete="new-password"
                        required
                    >


                    <small
                        class="error-message"
                        id="passwordError"
                    >

                        Password tidak sama.

                    </small>

                </div>



                <!-- =================================
                     BUTTON REGISTER
                     ================================= -->

                <button
                    class="btn"
                    type="submit"
                    name="register"
                >

                    Register

                </button>


                <!-- =================================
                     GOOGLE REGISTER
                     ================================= -->

                <div class="or-divider">

                    <span>atau</span>

                </div>


                <a
                    href="google-login.php?from=register"
                    class="google-btn"
                >

                    <span class="google-icon">G</span>

                    <span>Daftar dengan Google</span>

                </a>


            </form>



            <!-- =================================
                 LOGIN
                 ================================= -->

            <p class="login">

                Sudah punya akun?

                <a href="login.php">

                    Login

                </a>

            </p>


        </div>

    </div>


</div>



<script>


    /* =========================================
       AMBIL ELEMENT FORM
       ========================================= */

    const form =
        document.getElementById("registerForm");


    const password =
        document.getElementById("password");


    const konfirmasi =
        document.getElementById("konfirmasi_password");


    const passwordError =
        document.getElementById("passwordError");



    /* =========================================
       CEK PASSWORD
       ========================================= */

    function cekPassword() {


        if (konfirmasi.value === "") {

            passwordError.style.display = "none";

            konfirmasi.setCustomValidity("");

            return;
        }


        if (password.value !== konfirmasi.value) {

            passwordError.style.display = "block";

            konfirmasi.style.borderColor =
                "#e74c3c";

            konfirmasi.setCustomValidity(
                "Password tidak sama"
            );

        } else {

            passwordError.style.display = "none";

            konfirmasi.style.borderColor =
                "#2ecc71";

            konfirmasi.setCustomValidity("");

        }

    }



    /* =========================================
       CEK SAAT PASSWORD DIKETIK
       ========================================= */

    password.addEventListener(
        "input",
        cekPassword
    );


    konfirmasi.addEventListener(
        "input",
        cekPassword
    );


    /* =========================================
       VALIDASI FORM
       ========================================= */

    form.addEventListener(
        "submit",
        function(event) {

            cekPassword();


            if (!form.checkValidity()) {

                event.preventDefault();

                form.reportValidity();

            }

        }
    );

</script>


</body>

</html>
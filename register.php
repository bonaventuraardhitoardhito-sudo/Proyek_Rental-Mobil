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

    $cek = mysqli_query($conn, "SELECT * FROM customer WHERE email='$email'");

    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('Email sudah terdaftar!');</script>";
    } else {
        mysqli_query($conn, "INSERT INTO customer(nama,email,no_hp,password,status_verifikasi)
        VALUES('$nama','$email','$no_hp','$password','belum')");

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
           KOTAK REGISTER
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
            margin-bottom: 13px;
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

        .form-group input:focus {
            border-color: #1a7de7;

            background-color: #ffffff;

            box-shadow:
                0 0 0 3px rgba(26, 125, 231, 0.10);
        }

        .form-group input:invalid:not(:placeholder-shown) {
            border-color: #e74c3c;
        }

        .form-group input:valid:not(:placeholder-shown) {
            border-color: #2ecc71;
        }

        /* =========================
           PESAN ERROR
           ========================= */

        .error-message {
            display: none;

            color: #e74c3c;

            font-size: 11px;

            margin-top: 4px;
        }

        .form-group input:invalid:not(:placeholder-shown)
        + .error-message {
            display: block;
        }

        /* =========================
           BUTTON
           ========================= */

        .btn {
            width: 100%;

            height: 42px;

            margin-top: 5px;

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

        /* =========================
           LOGIN
           ========================= */

        .login {
            text-align: center;

            margin-top: 18px;

            color: #7a8794;

            font-size: 12px;
        }

        .login a {
            color: #1a7de7;

            text-decoration: none;

            font-weight: bold;
        }

        .login a:hover {
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

    <div class="logo">
        🚗
    </div>

    <h2>Register Customer</h2>

    <p class="subtitle">
        Buat akun untuk mulai menggunakan layanan
    </p>

    <form method="POST" id="registerForm" autocomplete="off">

        <!-- NAMA -->
        <div class="form-group">
            <label>Nama</label>

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
                Nama hanya boleh berisi huruf dan minimal 3 karakter.
            </small>
        </div>

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

            <small class="error-message">
                Masukkan alamat email yang valid.
            </small>
        </div>

        <!-- NO HP -->
        <div class="form-group">
            <label>No HP</label>

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
                Nomor HP harus berupa angka 10–13 digit.
            </small>
        </div>

        <!-- PASSWORD -->
        <div class="form-group">
            <label>Password</label>

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

        <!-- KONFIRMASI PASSWORD -->
        <div class="form-group">
            <label>Konfirmasi Password</label>

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

        <button
            class="btn"
            type="submit"
            name="register"
        >
            Register
        </button>

    </form>

    <p class="login">
        Sudah punya akun?
        <a href="login.php">Login</a>
    </p>

</div>

<script>

    const form = document.getElementById("registerForm");

    const password =
        document.getElementById("password");

    const konfirmasi =
        document.getElementById("konfirmasi_password");

    const passwordError =
        document.getElementById("passwordError");


    function cekPassword() {

        if (konfirmasi.value === "") {

            passwordError.style.display = "none";

            konfirmasi.setCustomValidity("");

            return;
        }

        if (password.value !== konfirmasi.value) {

            passwordError.style.display = "block";

            konfirmasi.style.borderColor = "#e74c3c";

            konfirmasi.setCustomValidity(
                "Password tidak sama"
            );

        } else {

            passwordError.style.display = "none";

            konfirmasi.style.borderColor = "#2ecc71";

            konfirmasi.setCustomValidity("");
        }
    }


    password.addEventListener("input", cekPassword);

    konfirmasi.addEventListener("input", cekPassword);


    form.addEventListener("submit", function(event) {

        cekPassword();

        if (!form.checkValidity()) {

            event.preventDefault();

            form.reportValidity();
        }

    });

</script>

</body>
</html>
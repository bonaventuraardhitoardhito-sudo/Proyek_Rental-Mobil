<?php

session_start();

include "config/koneksi.php";
require_once __DIR__ . '/google-config.php';


// ===============================
// CEK ERROR DARI GOOGLE
// ===============================
if (isset($_GET['error'])) {
    echo "<script>
            alert('Login dengan Google dibatalkan.');
            window.location='register.php';
          </script>";
    exit;
}


// ===============================
// CEK CODE
// ===============================
if (!isset($_GET['code'])) {
    echo "<script>
            alert('Kode Google tidak ditemukan.');
            window.location='register.php';
          </script>";
    exit;
}


// ===============================
// CEK STATE UNTUK KEAMANAN
// ===============================
if (
    !isset($_GET['state']) ||
    !isset($_SESSION['google_oauth_state']) ||
    $_GET['state'] !== $_SESSION['google_oauth_state']
) {
    echo "<script>
            alert('Permintaan Google tidak valid.');
            window.location='register.php';
          </script>";
    exit;
}


// Hapus state setelah digunakan
unset($_SESSION['google_oauth_state']);


// ===============================
// TUKARKAN CODE DENGAN TOKEN
// ===============================
$token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

if (isset($token['error'])) {
    echo "<script>
            alert('Gagal mendapatkan akses dari Google.');
            window.location='register.php';
          </script>";
    exit;
}

$client->setAccessToken($token);


// ===============================
// AMBIL DATA AKUN GOOGLE
// ===============================
$googleService = new Google\Service\Oauth2($client);

$googleUser = $googleService->userinfo->get();

$email = mysqli_real_escape_string(
    $conn,
    $googleUser->email
);

$nama = mysqli_real_escape_string(
    $conn,
    $googleUser->name
);


// ===============================
// CEK APAKAH EMAIL SUDAH ADA
// ===============================
$cek = mysqli_query(
    $conn,
    "SELECT * FROM customer WHERE email='$email'"
);


// ===============================
// JIKA SUDAH ADA
// ===============================
if (mysqli_num_rows($cek) > 0) {

    $data = mysqli_fetch_assoc($cek);

    $_SESSION['customer'] = $data['id_customer'];
    $_SESSION['nama_customer'] = $data['nama'];

    echo "<script>
            alert('Login dengan Google berhasil!');
            window.location='customer/dashboard.php';
          </script>";

    exit;
}


// ===============================
// JIKA BELUM ADA
// BUAT AKUN CUSTOMER OTOMATIS
// ===============================

$password_random = md5(
    bin2hex(random_bytes(16))
);

$nama = $nama ?: 'Pengguna Google';

$insert = mysqli_query(
    $conn,
    "INSERT INTO customer
    (nama, email, no_hp, password, status_verifikasi)
    VALUES
    ('$nama', '$email', '', '$password_random', 'belum')"
);


if (!$insert) {

    echo "<script>
            alert('Gagal membuat akun Google: " . mysqli_error($conn) . "');
            window.location='register.php';
          </script>";

    exit;
}


// Ambil ID customer yang baru dibuat
$id_customer = mysqli_insert_id($conn);


// Buat session login
$_SESSION['customer'] = $id_customer;
$_SESSION['nama_customer'] = $nama;


// ===============================
// REDIRECT KE DASHBOARD
// ===============================
echo "<script>
        alert('Akun Google berhasil dibuat!');
        window.location='customer/dashboard.php';
      </script>";

exit;
?>
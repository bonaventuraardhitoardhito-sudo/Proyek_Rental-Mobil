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
        echo "<script>alert('Email atau Password salah!');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Customer</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="form-box">
    <h2>Login Customer</h2>

    <form method="POST">
        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit" name="login" class="btn">
            Login
        </button>
    </form>

    <br>
    <p>
        Belum punya akun?
        <a href="register.php">Register</a>
    </p>
</div>

</body>
</html>
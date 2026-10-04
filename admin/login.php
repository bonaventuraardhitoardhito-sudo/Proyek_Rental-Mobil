<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include "../config/koneksi.php";

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $query = mysqli_query($conn, "SELECT * FROM admin WHERE email='$email' AND password='$password'");

    if (mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);

        $_SESSION['admin'] = $data['id_admin'];
        $_SESSION['nama_admin'] = $data['nama'];   

        echo "<script>
                alert('Login admin berhasil!');
                window.location='dashboard.php';
              </script>";
    } else {
        echo "<script>alert('Email atau password salah!');</script  >";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Admin</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<div class="form-box">
    <h2>Login Admin</h2>

    <form method="POST">
        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit" name="login" class="btn">Login</button>
    </form>
</div>

</body>
</html>
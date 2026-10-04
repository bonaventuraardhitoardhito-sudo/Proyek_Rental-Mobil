<?php
session_start();

unset($_SESSION['admin']);
unset($_SESSION['nama_admin']);

header("Location: login.php");
exit;
?>
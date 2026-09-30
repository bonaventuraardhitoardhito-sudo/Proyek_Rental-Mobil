<?php
session_start();

if (!isset($_SESSION['admin'])) {
    echo "<script>
            alert('Silakan login terlebih dahulu!');
            window.location='login.php';
          </script>";
    exit;
}

if (isset($_POST['update_stock_status'])) {
    $id_armada = $_POST['id_armada'];
    $stock = $_POST['stock'];
    $status = $_POST['status_ketersediaan'];

    mysqli_query($conn, "UPDATE armada
        SET stock='$stock',
            status_ketersediaan='$status'
        WHERE id_armada='$id_armada'
    ");

    echo "<script>
            alert('Stock dan status berhasil diperbarui!');
            window.location='armada.php';
          </script>";
}
?>
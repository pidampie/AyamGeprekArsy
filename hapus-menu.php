<?php
session_start();
include 'config.php';

// Cek Admin
if (!isset($_SESSION['Email']) || $_SESSION['role'] !== 'admin') {
    header("Location: login-page.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Hapus dari database
    $stmt = $conn->prepare("DELETE FROM menu WHERE ID_Menu = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>
                alert('Menu berhasil dihapus!');
                window.location.href = 'dashboard.php';
              </script>";
    } else {
        echo "Gagal menghapus.";
    }
}
?>
<?php
session_start();

// 1. Cek apakah sudah login?
if (!isset($_SESSION['ID_Pengguna'])) {
    header("Location: login-page.php");
    exit();
}

// 2. Cek apakah dia ADMIN?
// Jika role-nya bukan admin, kembalikan ke index
if ($_SESSION['role'] !== 'admin') {
    echo "<script>
            alert('Maaf, Anda bukan Admin! Tidak boleh masuk sini.');
            window.location.href = 'index.php';
          </script>";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Menu</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 450px;
            background: white;
            padding: 50px;
            margin: 50px auto;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #ff4d4d;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 15px;
        }

        input:focus, textarea:focus {
            border-color: #ff4d4d;
            outline: none;
            box-shadow: 0 0 5px rgba(255,77,77,0.5);
        }

        button {
            width: 100%;
            padding: 12px;
            margin-top: 20px;
            background: #ff4d4d;
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: 0.2s;
        }

        button:hover {
            background: #e63e3e;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #3cb371;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>

</head>
<body>

<div class="container">

    <h2>Tambah Menu Baru</h2>

    <form action="save-menu.php" method="POST" enctype="multipart/form-data">

        <label>Nama Menu:</label>
        <input type="text" name="name" required>

        <label>Harga:</label>
        <input type="number" name="price" required>

        <label>Deskripsi:</label>
        <textarea name="description" rows="4" required></textarea>

        <label>Gambar (upload):</label>
        <input type="file" name="image" accept="image/*" required>

        <button type="submit">Simpan Menu</button>

    </form>

    <a href="index.php" class="back-link">← Kembali ke Beranda</a>

</div>

</body>
</html>

<?php
session_start();
include 'config.php';

// Cek Admin
if (!isset($_SESSION['Email']) || $_SESSION['role'] !== 'admin') {
    header("Location: login-page.php");
    exit();
}

// Data Statistik
$queryMenu = mysqli_query($conn, "SELECT COUNT(*) as total FROM menu");
$dataMenu = mysqli_fetch_assoc($queryMenu);
$totalMenu = $dataMenu['total'];

$queryUser = mysqli_query($conn, "SELECT COUNT(*) as total FROM user");
$dataUser = mysqli_fetch_assoc($queryUser);
$totalUser = $dataUser['total'];

// Ambil Data Menu
$result = mysqli_query($conn, "SELECT * FROM menu ORDER BY ID_Menu DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="admin.css?v=<?php echo time(); ?>">
</head>
<body>

    <div class="sidebar">
        <h2>Admin Panel</h2>
        <a href="dashboard.php" class="active">Dashboard</a>
        <a href="index.php">Lihat Website</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="main-content">
        
        <h1>Dashboard Admin</h1>
        <p>Login sebagai: <strong><?= htmlspecialchars($_SESSION['Email']); ?></strong></p>

        <div class="cards-grid">
            <div class="card">
                <div>
                    <h3>Total Menu</h3>
                    <p><?= $totalMenu; ?></p>
                </div>
                <span style="font-size: 40px;">🍗</span>
            </div>
            <div class="card">
                <div>
                    <h3>Total User</h3>
                    <p><?= $totalUser; ?></p>
                </div>
                <span style="font-size: 40px;">👥</span>
            </div>
        </div>

        <div class="table-container">
            <div class="header-table">
                <h2>Daftar Menu Makanan</h2>
                <a href="add-menu.php" class="btn-add">+ Tambah Menu</a>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nama Menu</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                             if (!empty($row['Image'])) {
                                $gambar = base64_encode($row['Image']);
                                $imgSrc = 'data:image/jpeg;base64,'.$gambar;
                             } else {
                                $imgSrc = 'asset/no-image.jpg';
                             }
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><img src="<?= $imgSrc; ?>" width="50"></td>
                        <td><?= htmlspecialchars($row['Nama_Menu']); ?></td>
                        <td>Rp <?= number_format($row['Harga'], 0, ',', '.'); ?></td>
                        <td>
                            <a href="hapus-menu.php?id=<?= $row['ID_Menu']; ?>" class="btn-delete" onclick="return confirm('Hapus menu ini?');">Hapus</a>
                        </td>
                    </tr>
                    <?php 
                        }
                    } else {
                        echo "<tr><td colspan='5' style='text-align:center;'>Belum ada data menu.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="table-container" style="margin-top: 40px;">
            <div class="header-table">
                <h2>Data Riwayat Pesanan</h2>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama Pemesan</th>
                        <th>Menu Dipesan</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $resultPesanan = mysqli_query($conn, "SELECT * FROM pesanan ORDER BY tanggal DESC");
                    
                    $noPesan = 1;
                    if (mysqli_num_rows($resultPesanan) > 0) {
                        while ($rowP = mysqli_fetch_assoc($resultPesanan)) {
                    ?>
                    <tr>
                        <td><?= $noPesan++; ?></td>
                        <td><?= date('d-m-Y H:i', strtotime($rowP['tanggal'])); ?></td>
                        <td><strong><?= htmlspecialchars($rowP['nama_pemesan']); ?></strong></td>
                        <td><?= htmlspecialchars($rowP['nama_menu']); ?></td>
                        <td>Rp <?= number_format($rowP['harga'], 0, ',', '.'); ?></td>
                    </tr>
                    <?php 
                        }
                    } else {
                        echo "<tr><td colspan='5' style='text-align:center;'>Belum ada pesanan masuk.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        </div> 
    </body>
</html>
<?php
session_start();
// Include file konfigurasi database
include 'config.php';

// Include Header & Navbar agar tampilan konsisten
include 'header.php';
include 'navbar.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $Email = $_POST['Email'];
    $Password = $_POST['Password'];

    // 1. Cek apakah email sudah pernah terdaftar
    $cek_email = $conn->prepare("SELECT Email FROM user WHERE Email = ?");
    $cek_email->bind_param("s", $Email);
    $cek_email->execute();
    $result_cek = $cek_email->get_result();

    if ($result_cek->num_rows > 0) {
        $message = "Email sudah terdaftar, silakan gunakan email lain.";
    } else {
        // 2. ENKRIPSI PASSWORD
        $hashed_password = password_hash($Password, PASSWORD_DEFAULT);

        // 3. Masukkan data ke database
        $stmt = $conn->prepare("INSERT INTO user (Email, Password) VALUES (?, ?)");
        $stmt->bind_param("ss", $Email, $hashed_password);

        if ($stmt->execute()) {
            echo "<script>
                    alert('Pendaftaran Berhasil! Silakan Login.');
                    // PERBAIKAN: Redirect ke 'login-page.php' agar ada Header/Footer-nya
                    window.location.href = 'login-page.php'; 
                  </script>";
            exit();
        } else {
            $message = "Terjadi kesalahan sistem: " . $conn->error;
        }
    }
}
?>

<div class="login-wraper">
    <div class="login-container">
        <h2 style="text-align: center;">Daftar Akun Baru</h2>

        <?php if (!empty($message)) : ?>
            <p style="color: red; text-align: center;"><?= $message ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="input-group">
                <label>Email</label>
                <input type="email" name="Email" placeholder="Masukkan email aktif..." required>
            </div>

            <div class="input-group">
                <label>Password</label>
                <input type="password" name="Password" placeholder="Buat password..." required>
            </div>

            <button type="submit" class="login-submit">Daftar Sekarang</button>

            <p class="register-text">
                Sudah punya akun? <a href="login-page.php">Login di sini</a>
            </p>
        </form>
    </div>
</div>

<?php 
// Include Footer
include 'footer.php'; 
?>
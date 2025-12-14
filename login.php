<?php
// 1. MULAI SESSION PALING AWAL
session_start();
include 'config.php'; 

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $Email = $_POST['Email'];
    $Password = $_POST['Password'];

    // 2. CEK DATABASE
    $stmt = $conn->prepare("SELECT * FROM user WHERE Email = ?");
    $stmt->bind_param("s", $Email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // 3. VERIFIKASI PASSWORD
        if (password_verify($Password, $user['Password'])) {

            // === LOGIKA PENENTUAN ADMIN ===
            // GANTI EMAIL DI BAWAH INI SESUAI DATABASE ANDA
            // Pastikan penulisan persis (besar/kecil huruf, spasi, @gmail.com nya)
            $email_admin = "destaarya269@gmail.com";
            $email_admin = "fidaangelia9@gmail.com";

            if ($user['Email'] === $email_admin) {
                $_SESSION['role'] = 'admin';
            } else {
                $_SESSION['role'] = 'user';
            }

            // SIMPAN DATA UTAMA
            $_SESSION['Email'] = $user['Email'];
            
            // Cek ID (Jaga-jaga nama kolomnya id, ID, atau Id)
            if (isset($user['ID'])) $_SESSION['ID_Pengguna'] = $user['ID'];
            elseif (isset($user['id'])) $_SESSION['ID_Pengguna'] = $user['id'];
            else $_SESSION['ID_Pengguna'] = 1; // Fallback jika kolom ID tidak ketemu

            // === PENTING: PAKSA SIMPAN SESSION ===
            session_regenerate_id(true);
            session_write_close(); 

            // REDIRECT
            echo "<script>
                    alert('Login Berhasil sebagai: " . $_SESSION['role'] . "');
                    window.location.href = 'index.php';
                  </script>";
            exit();

        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Email tidak ditemukan!";
    }
}
?>

<div class="login-wraper">
    <div class="login-container">
        <h2>Login Pengguna</h2>
        <?php if (!empty($error)) : ?>
            <p style="color:red; text-align:center;"><?= $error ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="input-group">
                <label>Email</label>
                <input type="email" name="Email" placeholder="Masukkan email..." required>
            </div>
            <div class="input-group">
                <label>Password</label>
                <input type="password" name="Password" placeholder="Masukkan Password..." required>
            </div>
            <button type="submit" name="login" class="login-submit">Login</button>
            <p class="register-text">Belum punya akun? <a href="daftar.php">Daftar</a></p>
        </form>
    </div>
</div>
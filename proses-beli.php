<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_pemesan = $_POST['nama_pemesan'];
    $nama_menu = $_POST['nama_menu'];
    
    // PERBAIKAN: Paksa ubah harga jadi angka (integer)
    // Jika kosong, otomatis jadi 0, sehingga tidak error
    $harga = isset($_POST['harga_menu']) ? (int)$_POST['harga_menu'] : 0;

    // 1. SIMPAN KE DATABASE
    $stmt = $conn->prepare("INSERT INTO pesanan (nama_pemesan, nama_menu, harga) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $nama_pemesan, $nama_menu, $harga);
    
    if ($stmt->execute()) {
        // 2. JIKA BERHASIL, ALIH KAN KE WHATSAPP
        // Format pesan WA
        $pesan = "Halo kak! Saya *$nama_pemesan* mau pesan:\n";
        $pesan .= "- Menu: $nama_menu\n";
        
        // Sekarang number_format aman karena $harga pasti angka
        $pesan .= "- Harga: Rp " . number_format($harga, 0, ',', '.') . "\n\n";
        $pesan .= "Mohon diproses ya!";

        $encoded_pesan = urlencode($pesan);
        
        // Ganti nomor WA di bawah ini
        $nomor_wa = "6289507572970"; 
        
        header("Location: https://wa.me/$nomor_wa?text=$encoded_pesan");
        exit();
    } else {
        echo "Gagal menyimpan pesanan: " . $conn->error;
    }
}
?>